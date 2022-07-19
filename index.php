<?php
	require "./vendor/autoload.php";
	require "./Configuracao/ConfiguradorGeral.php";

	use Configuracao\ConfiguradorControlador as Inicio;
	$url = new Inicio();
	$url->carregarCntrldr();
?>