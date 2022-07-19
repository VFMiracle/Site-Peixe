<?php

namespace App\site\controladores\base;

if (!defined('URL')){
	header("location: /");
	exit();
}

class ControladorBase{
	
	protected $dados;
	
	/*Carregar uma página com base em seu nome. Recebe o controlador e o método que preparam as informações específicas da página e o nome da página.*/
	protected function carregarPagina($controlador, $metodo, $nomePagina){
		$this->dados['controlador'] = $controlador;
		$this->dados['metodo'] = $metodo;
		/*Criar uma instancia do configurador visual e inicializa-la com o nome de página recebido e as propriedades principais que foram montadas.*/
		$cnfgrdrVisual = new \Configuracao\ConfiguradorVisual($nomePagina, $this->dados);
		/*Renderizar a página cujo o nome foi utilizado para inicializar a instância do configurador visual.*/
		$cnfgrdrVisual->renderizar();
	}
}
