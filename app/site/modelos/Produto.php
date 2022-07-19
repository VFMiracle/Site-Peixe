<?php
namespace App\site\modelos;
if (!defined('URL')) {
	header("Location: /");
	exit();
}

class Produto{
	
	/*Retornar um dicionário de toda a informação de exibição de um produto cujo id é igual ao valor que foi recebido.*/
	public function buscarInfoExbcCmpltPrdt($idProduto){
		$modeloLeitor = new \Site\modelos\auxiliar\ModeloLeitor();
		/*Buscar no banco de dados por uma lista de todas as informações de exibição do produto de id recebido. Essas informações se tratam de: id, nome, descrição, quantidade em estoque, um indicador que determina se a quantidade em estoque é estimada ou não, preço, unidade de venda, unidade do estoque, tipo e grupo.*/
		$todaInfoExbc = $modeloLeitor->lerEspecifico("SELECT prod.Id, prod.Nome, prod.Descricao, prod.Estoque, prod.EstoqueEEstmd, prod.Preco, uni.UnidadeVenda, uni.UnidadeEstoque, t_prod.Tipo, t_prod.Grupo
			FROM produto AS prod
			INNER JOIN unidade AS uni ON prod.Unidade = uni.Id
			INNER JOIN tipo_produto AS t_prod ON prod.Tipo = t_prod.Id
			WHERE prod.Id = :idSlcnd",
			array("idSlcnd" => $idProduto));
		/*Caso a quantidade em estoque do produto seja um valor inteiro, evitar exibir quaisquer números que venham após a vírgula.*/
		if(((float)$todaInfoExbc["Estoque"] - (int)$todaInfoExbc["Estoque"]) == 0) {$todaInfoExbc["Estoque"] = (string)(int)$todaInfoExbc["Estoque"];}
		$todaInfoExbc["EstoqueEEstmd"] = (bool)$todaInfoExbc["EstoqueEEstmd"];
		return $todaInfoExbc;
	}

	/*Retornar uma lista em que cada produto do banco de dados está ordenado pelo seu tipo, e os tipos estão ordenados pelos seus grupos.*/
	public function buscarIdsPorTipo(){
		$infoTipoPorPrdt = [];
		$prdtsPorTipo = [];
		$modeloLeitor = new \Site\modelos\auxiliar\ModeloLeitor();
		/*Buscar no banco de dados por uma lista composta pelos ids de todos os produtos, seus respectivos tipos e os grupos de seus tipos.*/
		$infoTipoPorPrdt = $modeloLeitor->lerEspecifico("SELECT prod.Id, t_prod.Tipo, t_prod.Grupo
			FROM produto AS prod
			INNER JOIN tipo_produto AS t_prod ON prod.Tipo = t_prod.Id");
		/*Montar uma lista em que cada entrada 'Grupo' é uma lista dos tipo de produto pertencentes a esse grupo, e cada entrada 'Tipo' é uma lista dos ids de produtos desse tipo.*/
		foreach($infoTipoPorPrdt as $infoTipoProduto){
			if (!array_key_exists($infoTipoProduto['Grupo'], $prdtsPorTipo)) {$prdtsPorTipo[$infoTipoProduto['Grupo']] = [];}
			if (array_key_exists($infoTipoProduto['Tipo'], $prdtsPorTipo[$infoTipoProduto['Grupo']])) {array_push($prdtsPorTipo[$infoTipoProduto['Grupo']][$infoTipoProduto['Tipo']], $infoTipoProduto['Id']);}
			else {$prdtsPorTipo[$infoTipoProduto['Grupo']][$infoTipoProduto['Tipo']] = [$infoTipoProduto['Id']];}
		}
		/*Retornar uma lista dos ids dos produtos organizados por seus tipos e grupos.*/
		return $prdtsPorTipo;
	}
	
	/*Retornar uma lista de todos os produtos registrados, a qual possui a menor quantidade de informações que o usuário deve ter acesso para que ele possa realizar uma compra.*/
	public function buscarInfoExbcSmplsPrdts(){
		$modeloLeitor = new \Site\modelos\auxiliar\ModeloLeitor();
		/*Buscar no banco de dados por uma lista dos registros de produto, a qual possui as seguintes informações: id, nome, preço e unidade de venda.*/
		$infoPrncplProdutos = $modeloLeitor->lerEspecifico("SELECT prod.Id, prod.Nome, prod.Preco, uni.UnidadeVenda
			FROM produto AS prod
			INNER JOIN unidade AS uni ON prod.Unidade = uni.Id");
		return $infoPrncplProdutos;
	}
}