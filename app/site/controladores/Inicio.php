<?php

namespace App\site\controladores;

 if (!defined('URL')){
     header('location: /');
     exit();
 }

class Inicio extends base\ControladorBase {

	/*Preparar e caregar a página 'index'.*/
    public function index() {
		$this->dados = ['mdfcssVisuais' => [
			'exclude' => ['top-banner' => true]
		]];
		/*Carregar a página 'index' por meio de seu controlador e método.*/
		$this->carregarPagina('Inicio', 'index', 'index');
    }
}
