<?php
namespace Site\modelos\auxiliar;
use PDO;
if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModeloConector{

    private static $conexaoBd = null;

	/*Conectar o query ao banco de dados para que possa ser executado mais tarde.*/
    protected static function conectarQueryBd($query, $usarRetornoAscd = false){
		/*Estabelecer uma conexão com o banco de dados.*/
		self::conectarBd();
        /*Conectar o query recebido ao banco de dados, depois retornar um objeto que representa essa conexão.*/
        $conexaoQueryBd = self::$conexaoBd->prepare($query);
		/*Caso a função tenha recebido confirmação, modificar a conexão do query ao banco de dados para que ela retorne as informações de cada registro no formato associado ('nome da propriedade' => 'valor dessa propriedade neste registro').*/
        if($usarRetornoAscd) {$conexaoQueryBd->setFetchMode(PDO::FETCH_ASSOC);}
		return $conexaoQueryBd;
    }

	/*Estabelecer e salvar uma conexão ao banco de dados.*/
    private static function conectarBd(){
		/*Tenta estabelecer uma conexão com o banco de dados e modifica-la para que retorne quaisquer erros como exeções PHP, caso uma já não tenha sido salva. Se a tentativa falhar uma mensagem de erro será exibida e a execução do programa será finalizada.*/
        try{
            if (self::$conexaoBd == null) {
                self::$conexaoBd = new PDO('mysql:host=' . HOSPEDEIRO . ';dbname=' . NOME_BD .";charset=utf8", ACESSO_USUARIO, SENHA);
				self::$conexaoBd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }
	
	/*A função de conexão com o banco de dados fica aqui.*/
}
