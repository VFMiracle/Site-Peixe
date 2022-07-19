<?php

namespace Site\modelos\auxiliar;
use PDO;
use PDOException;
if (!defined('URL')){
    header("location: /");
    exit();
}

class ModeloModificador extends ModeloConector {
	
	public const TIPOSMDFCC = array("Inserir" => 0, "Atualizar" => 1, "Deletar" => 2);
	
	//QUERY
	private $conexaoQueryBd;
    private $dadosSqlMdfcr;
    private $nomeTabela;
    private $queryMdfcc;

	/*Modificar uma das tabelas do banco de dados salvo. Recebe o nome da tabela ser modificada, o id do tipo de modificação que será realizada e as informações que especificão o que será modificado.*/
    public function modificar($nomeTabela, $mdfccSel, array $dadosSqlMdfcr){
        $this->nomeTabela = (string) $nomeTabela;
        $this->dadosSqlMdfcr = $dadosSqlMdfcr;
		
		/*Usar o id de tipo de modificação que foi recebido para chamar um dos métodos de montagem de query.*/
        $this->slcnrMdfcc($mdfccSel);
		/*Retornar o resultado da execução do query que foi montado.*/
        return $this->executarQuery();
    }
	
	/*Chamar um dos métodos de montagem de query com base no número inteiro recebido.*/
	private function slcnrMdfcc($mdfccSel){
		/*Comparar o número inteiro recebido aos ids dos tipos de modificação que podem ser realizados em uma tabela SQL. Então, deve-se chamar o método que monte o query que realize o tipo de modificação cujo id é igual ao número inteiro recebido.*/
		switch($mdfccSel){
			case self::TIPOSMDFCC["Inserir"]:
				$this->montarInsercao();
				break;
			case self::TIPOSMDFCC["Atualizar"]:
				$this->montarAtualizacao();
				break;
			case self::TIPOSMDFCC["Deletar"]:
				$this->montarDelecao();
				break;
		}
	}

	/*Conectar e executar o query no banco de dados salvo. Retornar verdadeiro ou falso dependendo de se o query foi executado com sucesso ou não.*/
    private function executarQuery(){
		/*Conectar o query ao banco de dados.*/
        $this->conexaoQueryBd = parent::conectarQueryBd($this->queryMdfcc);
        try { /*Tentar executar o query no banco de dados ao qual ele foi conectado e retornar verdadeiro ou falso dependendo de se execução foi bem sucedida ou não.*/
            $resultado = $this->conexaoQueryBd->execute();
			return $resultado;
        }catch (PDOException $e) { /*Caso a tentativa falhe, a mensagem do erro lançado pela conexão entre o query e o banco de dados é exibida e a função retorna falso.*/
            echo "<strong>Erro ao adicionar dados:</strong> {$e->getMessage()}";
			return false;
        }
    }

	/*Montar o query de inserção.*/
    private function montarInsercao(){
		/*Montar o query de inserção utilizando o nome de tabela salvo e uma versão em texto da lista de propriedades que serão utilizadas neste(s) novo(s) registro(s).*/
		$listaChaves = array_keys($this->dadosSqlMdfcr);
        $textoChaves = implode(', ', $listaChaves);
        $this->queryMdfcc = "INSERT INTO {$this->nomeTabela} ({$textoChaves}) VALUES";
        
		/*Montar uma mariz em que cada entrada se trata de uma lista de informações a serem inseridas em cada uma das propriedades de tabela SQL que foram descritas no query anteriormente. E as entradas de cada uma dessas listas que estão na mesma posição são o conjunto de informações que compõem um dos registros a serem inseridos.*/
		$matrizValores = array_values($this->dadosSqlMdfcr);
		for($indexReg = 0; $indexReg < count($matrizValores[0]); $indexReg++){ //Passar por cada posição da primeira lista de informações de registros da matriz de valores a serem inseridos na tabela do banco de dados. E com isso...
			$listaPrprddsReg = array();
			foreach($matrizValores as $listaInfoPrprdd){ //Adicionar à lista de propriedades do registro aquilo que se encontra na posição de registro salva de cada uma das listas de informação da matriz de valores a inserir.
				array_push($listaPrprddsReg, $listaInfoPrprdd[$indexReg]);
			}
			/*Montar um texto que contém as informações de um novo registro a ser inserido na tabela do banco de dados que possui o nome salvo. Além disso, um ';' ou uma ',' será inserido no final do texto caso este registro seja, ou não, o último a ser inserido. Esse texto é então adicionado ao query de inserção.*/
			$textoPrprddsReg = "\n('". implode("', '", $listaPrprddsReg) ."')" .($indexReg < count($matrizValores[0]) - 1 ? "," : ";");
			$this->queryMdfcc .= $textoPrprddsReg;
		}
    }
	
	private function montarAtualizacao(){
		
	}
	
	private function montarDelecao(){
		
	}
}
