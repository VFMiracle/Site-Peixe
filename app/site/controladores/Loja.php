<?php

namespace App\site\controladores;

if (!defined('URL')){
	header("location: /");
	exit();
}

define("NOME_CAMPO_QTD_CMPRD_PRDT", "qtdProduto");

class Loja extends base\ControladorBase {
	
	public function detalhe($idProdutoSlcnd){
		$modeloProduto = new \App\site\modelos\Produto();
        $modeloPagina = new \App\site\modelos\Pagina();
		//Buscar as informções de exibição do produto e utilizar o nome dele para montar o título da página.
		$this->dados["produto"] = $modeloProduto->buscarInfoExbcCmpltPrdt($idProdutoSlcnd);
		$this->dados["titulo"] = $modeloPagina->buscarTitulo('Loja', 'detalhe');
		$this->dados["titulo"] .= $this->dados["produto"]["Nome"];
		
		//Se o produto foi comprado, ele será adicionado ao carrinho ou a sua quantidade já presente nele aumentará. 
		if(count($_GET) > 0){
			$idProdutoCmprd = $this->dados["produto"]["Id"];
			$infoCompraProduto =& $_SESSION["carrinho"][$idProdutoCmprd];
			//Caso o produto comprado ainda não esteja no carrinho, uma lista de suas informações será adicionada a esse, caso contrário, a quantidade comprada será adicionada àquela já existente no carrinho.
			if(!isset($_SESSION["carrinho"][$idProdutoCmprd])){
				$infoCompraProduto =& $_SESSION["carrinho"][$idProdutoCmprd];
				$infoCompraProduto["Nome"] = $this->dados["produto"]["Nome"];
				$infoCompraProduto["Preco"] = $this->dados["produto"]["Preco"];
				$infoCompraProduto["Grupo"] = $this->dados["produto"]["Grupo"];
				$infoCompraProduto["Tipo"] = $this->dados["produto"]["Tipo"];
				$infoCompraProduto["UnidadeVenda"] = $this->dados["produto"]["UnidadeVenda"];
				$infoCompraProduto["QtdCmprd"] = (int)$_GET["QtdCmprd"];
			}else 
				$infoCompraProduto["QtdCmprd"] += (int)$_GET["QtdCmprd"];
			$this->calcularPrecoCarrinho();
		}
		$this->carregarPagina('Loja', 'detalhe', 'loja-detalhada');
	}
	
	public function carrinho(){
		//INFO: Esta função não recebe nenhum formulário 'GET'. A checagem verifica se nenhum pedido de método 'GET' foi realizado pela página.
		//Se um pedido de método 'GET' foi recebido, alterar o carrinho de acordo com ele e enviar o novo preço desse como resposta.
		if(empty($_GET) == false){
			//OBS: Se o processamento chegar a este ponto é garantido que uma das verificações vai rodar. As descrições dos 'if's de cada uma servem principalmente para melhorar a clareza do código.
			//Se o pedido tiver uma chave 'idPrdtARmvr', remover o produto do carrinho cujo id é igual ao valor dela. Já se a chave do pedio tiver o nome do campo HTML de quantidade de um dos produtos, a quantidade salva deles vai ser atualizada.
			if(isset($_GET["idPrdtARmvr"])){unset($_SESSION["carrinho"][$_GET["idPrdtARmvr"]]);}
			//INFO: A função 'atlzrQtdPrdtsCrnh' lê valores diretamente do $_GET, então as informações do pedido não precisam ser enviadas para ela.
			else if(substr(array_keys($_GET)[0], 0, strlen(NOME_CAMPO_QTD_CMPRD_PRDT)) == NOME_CAMPO_QTD_CMPRD_PRDT) {$this->atlzrQtdPrdtsCrnh();}
			echo($this->calcularPrecoCarrinho());
		//Porém, se nenhum pedido 'GET' foi recebido, carregar a página 'carrinho'.
		}else $this->carregarPagina('Loja', 'carrinho', 'carrinho');
	}
	
	public function checkout(){
		$modeloRegiao = new \App\Site\modelos\Regiao();
		//INFO: Esta função não recebe nenhum formulário 'GET'. A checagem verifica se nenhum pedido de método 'GET' foi realizado pela página.
		//Caso nenhum pedido de método 'GET' tenha sido realizado, verificar se houve e responder ao pedido de método 'POST' que foi recebido. Caso nenhum tenha ocorrido, carregar a página.
		if(empty($_GET)){
			$infoPura_POST = file_get_contents('php://input');
			//Caso um pedido pelo segredo de pagamento do cliente seja recebido, esse será montado com base no custo total do carrinho e enviado como resposta.
			if($infoPura_POST != ''){
				if(json_decode($infoPura_POST, true)['deveMontrSgrdPgmntClnt']){
					//OBS: O código abaixo se trata da chave privada de teste do Stripe. Ele será substituido pela chave oficial quando adquirir-se uma assinatura com o Stripe.
					\Stripe\Stripe::setApiKey('sk_test_51JNzAhJw9GgPwoWe5Ftqcq0Lp9gGjJIk38r7OoaI1Gzqd7MaVdIU28YJi8z6foutXan9bpc5cLf3FMg6SqAq2Iew00GgK3aUaP');
					//OBS: Um 'PaymentIntent' se trata de um objeto do sistema Stripe responsável por registrar todas as informações de uma tentativa de pagamento, incluindo seu estado atual.
					$infoPgmntEmStrp = \Stripe\PaymentIntent::create([
						'amount' => intval($_SESSION['precoCrnh'] * 100),
						'currency' => 'brl'
					]);
					echo(json_encode($infoPgmntEmStrp->client_secret));
				}
			//INFO: Carregamento inicial da página.
			//Caso nenhum pedido de método 'POST' tenha sido realizado, montar as listas iniciais de cidades e estados e carregar a página.
			}else{
				var_dump($_POST);
				var_dump($_SESSION);
				//Buscar uma lista de todos os estados que estão no banco de dados e outra composta por todas as cidades do banco de dados que pertencem ao primeiro estado dessa lista.
				$this->dados['nomesEstados'] = $modeloRegiao->buscarNomesEstados();
				$this->dados['nomesCddsPrmrEstd'] = $modeloRegiao->buscarNomesCidadesEstado($this->dados['nomesEstados'][0]);

				$this->carregarPagina('Loja', 'checkout', 'checkout');
			}
		//Caso um pedido por um HTML da lista de cidades pertencentes ao estado descrito nele, tenha sido realizado, montar esse e envia-lo como resposta.
		}else echo($this->montarHTMLOpcsCddsEstd($_GET['estdOpcsCddsAExbr']));
	}
	
	public function principal(){
		$modeloProduto = new \App\site\modelos\Produto();
		$this->dados['produtos'] = $modeloProduto->buscarInfoExbcSmplsPrdts();
		$this->dados['prdtsPorTipo'] = $modeloProduto->buscarIdsPorTipo();
		//Passar pelas listas de produtos a serem exibidos e de ids de produto organizados por tipo e grupo, para adicionar as informações corretas desses campos a cada um dos elementos da primeira lista.
		foreach($this->dados['produtos'] as &$produto) {foreach($this->dados['prdtsPorTipo'] as $possGrupoProduto => $possTiposProduto){
			//Passar pelo dicionário de ids de produto por tipo ao qual eles pertencem, e determinar se o produto atual pertence ao tipo atual, para que o tipo e o grupo do produto sejam adicionados as suas informações.
			foreach($possTiposProduto as $possTipoProduto => $idsPrdtEmTipo) {if (in_array($produto['Id'], $idsPrdtEmTipo)){
				$produto['Grupo'] = $possGrupoProduto;
				$produto['Tipo'] = $possTipoProduto;
				break;
			}}
			if (array_key_exists('Grupo', $produto)) {break;}
		}}
		$this->carregarPagina('Loja', 'principal', 'loja-principal');
	}
	
	private function montarHTMLOpcsCddsEstd($estado){
		$modeloRegiao = new \App\Site\modelos\Regiao();
		$nomesCidadesEstado = $modeloRegiao->buscarNomesCidadesEstado($estado);
		$opcsCddsEmHTML = "";
		foreach($nomesCidadesEstado as $nomeCidade){$opcsCddsEmHTML .= "<option value=$nomeCidade>$nomeCidade</option>\n";}
		return $opcsCddsEmHTML;
	}
	
	private function atlzrQtdPrdtsCrnh(){
		foreach($_GET as $idCampoQtdPrdt => $novaQtdPrdt) {$_SESSION["carrinho"][(int)substr($idCampoQtdPrdt, strlen(NOME_CAMPO_QTD_CMPRD_PRDT))]["QtdCmprd"] = (int)$novaQtdPrdt;}
	}
	
	private function calcularPrecoCarrinho(){
		$_SESSION["precoCrnh"] = 0;
		foreach($_SESSION["carrinho"] as $compra) {$_SESSION["precoCrnh"] += $compra["Preco"] * $compra["QtdCmprd"];}
		return $_SESSION["precoCrnh"];
	}
}

?>