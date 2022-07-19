<?php

namespace App\site\controladores;

if (!defined('URL')){
	header('location: /');
	exit();
}

class Usuario extends base\ControladorBase {
	
	/*Preparar e caregar a página 'perfil'.*/
	public function perfil(){
		/*Carregar a página 'perfil' por meio de seu controlador e método.*/
		$this->carregarPagina('Usuario', 'perfil', 'perfil');
	}
}

?>