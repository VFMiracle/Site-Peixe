<?php
namespace App\site\modelos;
if(!defined('URL')){
	header("Location: /");
	exit();
}

class Regiao{
	
	public function buscarNomesCidadesEstado($nomeEstadoSlcnd){
		$modeloLeitor = new \Site\modelos\auxiliar\ModeloLeitor();
		$nomesCidadesEstado = $modeloLeitor->lerEspecifico("SELECT cdd.Nome
			FROM cidade AS cdd
			INNER JOIN estado AS estd ON cdd.Estado = estd.Id
			WHERE estd.Nome = :nomeEstadoSlcnd",
			array("nomeEstadoSlcnd" => $nomeEstadoSlcnd));
		return $nomesCidadesEstado;
	}
	
	public function buscarNomesEstados(){
		$modeloLeitor = new \Site\modelos\auxiliar\ModeloLeitor();
		$nomesEstados = $modeloLeitor->lerEspecifico("SELECT estd.Nome
			FROM estado AS estd");
		return $nomesEstados;
	}
}
