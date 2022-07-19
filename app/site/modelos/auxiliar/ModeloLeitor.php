<?php

namespace Site\modelos\auxiliar;
use PDO;
if (!defined('URL')){
    header("location: /");
    exit();
}

class ModeloLeitor extends ModeloConector {

	//QUERY
    private $conexaoQueryBd;
    private $querySelecao;
    private $valorPorIncgntQuery;

    public function lerGeral($tabela, $especificacao = null, $valorPorIncgntQuery = null) {
        if (!empty($valorPorIncgntQuery)) {$this->valorPorIncgntQuery = $valorPorIncgntQuery;}
        $this->querySelecao = "SELECT * FROM {$tabela} {$especificacao}";
        return $this->executarQuery();
    }

    public function lerEspecifico($querySelecao, $valorPorIncgntQuery = null) {
		if (!empty($valorPorIncgntQuery)) {$this->valorPorIncgntQuery = $valorPorIncgntQuery;}
        $this->querySelecao = (string) $querySelecao;
        return $this->executarQuery();
    }

    private function executarQuery(){
        $this->conexaoQueryBd = parent::conectarQueryBd($this->querySelecao, true);
		//Tentar executar o query com suas incógnitas substituídas por seus respectivos valores e retornar o resultado sem nenhuma sudivisão desnecessária.
        try{
            $this->removerIncgntsQuery();
            $this->conexaoQueryBd->execute();
			return $this->removerSbdvssRsltd($this->conexaoQueryBd->fetchAll());
		//Caso a tentativa falhe, a mensagem do erro lançado pela execução do query é exibida e a função retorna o valor nulo.
        }catch (PDOException $e){
            echo "<strong>Erro ao ler dados:</strong> {$e->getMessage()}";
			return null;
        }
    }

    private function removerIncgntsQuery(){
		//Se um dicionário de valores por incógnitas do query estiver salvo, passa-se por cada uma e substitui-se suas instâncias nesse por seus valores correspondentes, os quais vão estar no formato string', exceto as incógnitas 'limit' e 'offset', as quais vão ter valores no formato 'int'.
        if ($this->valorPorIncgntQuery) {foreach ($this->valorPorIncgntQuery as $incognita => $valor) {
			if ($incognita == 'limit' || $incognita == 'offset') {$valor = (int)$valor;}
			$this->conexaoQueryBd->bindValue(":{$incognita}", $valor, (is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
		}}
    }
	
	private function removerSbdvssRsltd($rsltdBase){
		$rsltdOrgnzd;
		//Caso o resultado base do query seja composto por múltiplas entradas, ele somente será reorganizado se elas tiverem apenas uma propriedade.
		if (count($rsltdBase) != 1){
			//Caso as entradas do resultado tenham somente uma propriedade, ele será reorganizado em uma nova lista composta pelos valores dessa propridade em cada entrada. Caso contrário, o resultado não sofrerá nenhuma reorganização.
			if(count($rsltdBase[0]) == 1){
				$rsltdOrgnzd = [];
				foreach($rsltdBase as $listaUntrPrprdds){$rsltdOrgnzd[] = $listaUntrPrprdds[array_keys($listaUntrPrprdds)[0]];}
			}else{ $rsltdOrgnzd =& $rsltdBase; }
		//Caso contrário, será retornado um valor singular (string, int , float, etc.) ou um dicionário, dependendo da quantidade propriedades que a entrada tiver.
		}else{
			//Caso a entrada seja composta por somente uma propriedade, somente o valor dessa será retornado. Caso contrário, a entrada é copiada para um dicionário externo ao resultado para que esse seja retornado.
			if (count($rsltdBase[0]) == 1) {$rsltdOrgnzd = $rsltdBase[0][array_keys($rsltdBase[0])[0]];}
			else {$rsltdOrgnzd = $rsltdBase[0];}
		}
		return $rsltdOrgnzd;
	}
}