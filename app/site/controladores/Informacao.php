<?php

namespace App\site\controladores;

if (!defined('URL')){
	header('location: /');
	exit();
}

class Informacao extends base\ControladorBase {
	
	/*Preparar e caregar a página 'contato'.*/
	public function contato(){
		/*Carregar a página 'contato' por meio de seu controlador e método.*/
		$this->carregarPagina('Informacao', 'contato', 'contato');
	}
}

?>