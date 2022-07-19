<?php
namespace App\site\models;
/*
$pasta = glob("./app/Site/Models/helper/*.php");
foreach ($pasta as $arquivo){require $arquivo;}
*/
if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Testagem{
    private $result;
    private $urlController;
    private $urlMetodo;

    public function listarTestes(){
        $listar = new \Site\models\helper\ModelsRead();
		$listar->exeRead("teste", "WHERE Numero < 2");
		return $listar->getResult();
    }
}
