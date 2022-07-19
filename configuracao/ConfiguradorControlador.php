<?php
namespace Configuracao;

class ConfiguradorControlador{
	
	private $classeGlobalCntrldr;
	
	private $cntrldrSlcnd;
	private $metodoSlcnd;
	private $prmtrSlcnd;

	public function __construct(){
		//OBS: Esta função aplica o filtro descrito no terceiro parâmetro na variável da fonte externa do primeiro parâmtero que tem o nome escrito no segundo parâmetro. Neste caso, o filtro utilizado não faz nenhuma alteração na variável.
		$url = filter_input(INPUT_GET, "url", FILTER_DEFAULT);
		//Caso alguma informação tenha sido enviada pela URL além do nome do site, ela é salva para ser executada pelas outras funções deste script.
		if (!empty($url)){
			$this->limparUrl($url);
			//INFO: O array abaixo pode conter de 1 até 3 elementos que se tratam dos termos selecionados pela URL, e cada index sempre representa: 0 - Controlador, 1 - Método, 2 - Parâmetro.
			//OBS: Este array não é indexado porque a função 'explode' somente retorna arrays desse tipo, e não há maneira eficiente de transferir suas informações para um array indexado.
			$cnjntUrl = explode('/', $url);
			$this->cntrldrSlcnd = $this->prepararCntrldr($cnjntUrl[0]);

			//Se a lista de informações da URL tiver algum método descrito, ele é selecionado. Se não, o método padrão do controlador é salvo em seu lugar.
			if (isset($cnjntUrl[1]))
				$this->metodoSlcnd = $cnjntUrl[1];
			else
				$this->metodoSlcnd = METODO[$this->cntrldrSlcnd];

			//Se a lista de informações da URL tiver algum parâmetro descrito, ele será salvo. Caso contrário, é salvo que nenhum parâmetro foi selecionado.
			if (isset($cnjntUrl[2]))
				$this->prmtrSlcnd = $cnjntUrl[2];
			else
				$this->prmtrSlcnd = null;
		//Caso contrário, são salvos os valores padrão dos termos a serem executados.
		}else{
			$this->cntrldrSlcnd = CONTROLADOR;
			$this->metodoSlcnd = METODO[$this->cntrldrSlcnd];
			$this->prmtrSlcnd = null;
		}
	}

	public function carregarCntrldr(){
		$modeloPagina = new \App\site\modelos\Pagina();
		$tipoPagina = $modeloPagina->buscarTipo($this->cntrldrSlcnd, $this->metodoSlcnd);
		//Se há um tipo no banco de dados para a página com as informações selecionadas, tentar carrega-la.
		if ($tipoPagina != null){
			$this->classeGlobalCntrldr = "\\App\\{$tipoPagina}\\Controladores\\{$this->cntrldrSlcnd}";
			//Caso não exista um controlador com a classe salva, selecionar o método e controlador de erro, e reiniciar o processo de carregamento. Caso contrário, executar o método selecionado.
			if (!class_exists($this->classeGlobalCntrldr)){
				$this->cntrldrSlcnd = ERRO404;
				$this->metodoSlcnd = "index";
				$this->carregarCntrldr();
			}else
				$this->carregarMetodo();
		//Caso contrário, selecionar o método e controlador de erro, e reiniciar o processo de carregamento.
		}else{
			$this->cntrldrSlcnd = ERRO404;
			$this->metodoSlcnd = "index";
			$this->carregarCntrldr();
		}
	}

	private function limparUrl(&$url){
		$url = strip_tags($url);
		$url = trim($url, "/ \t\n\r\0\x0B");
		
		$chaveTrdc = [
			"charsOrgns" =>  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ',
			"charsTrdzds" => 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------'
		];
		//OBS: Assumir que a função 'strtr' não consegue lidar com strings de codificação "UTF-8" e que PHP automaticamente dá codificação "UTF-8" a strings com caracteres acentuados. Assim, a conversão nos parâmetros usados abaixo é necessária. Isso é "assumido" pois buscar informações sobre a maneira como PHP e suas funções lidam com "UTF-8" provou-se complicado demais para gastar mais tempo nisso valer a pena.
		$url = strtr(utf8_decode($url), utf8_decode($chaveTrdc["charsOrgns"]), $chaveTrdc["charsTrdzds"]);
	}

	private function carregarMetodo(){
		$instncClasseCntrldr = new $this->classeGlobalCntrldr;
		//Se o método selecionado existir no controlador selecionado, chamar ele levando o parâmetro selecionado em conta.
		if (method_exists($instncClasseCntrldr, $this->metodoSlcnd)) {
			//Se o parâmetro for diferente de null, chamar o método utilizando-o. Caso contrário, chamar o método por si só.
			if ($this->prmtrSlcnd != null)
				$instncClasseCntrldr->{$this->metodoSlcnd}($this->prmtrSlcnd);
			else
				$instncClasseCntrldr->{$this->metodoSlcnd}();
		//Se esse não for o caso, selecionar o método padrão do controlador e reiniciar o processo.
		}else{
			$this->metodoSlcnd = METODO[$this->cntrldrSlcnd];
			$this->carregarMetodo();
		}
	}

	private function prepararCntrldr($controlador){
		//Garantir que o controlador recebido esteja em PascalCase, para isso capitalize cada uma de suas palavras e remova quaisquer separadores entre elas.
		$controlador = strtolower($controlador);
		$controlador = ucwords($controlador, " \t\r\n\f\v-");
		$controlador = str_replace(array(" ", "-"), "", $controlador);
		
		return $controlador;
	}
}
