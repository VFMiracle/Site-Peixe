<?php

namespace Configuracao;

class ConfiguradorVisual{

    private $dados;
    private $nome;

	/*Criar uma instância do Configurador Visual inicializada com o nome da página a ser aberta e as propriedades que ela deve possuir.*/
    public function __construct($nome, array $dados = null){
        $this->nome = (string) $nome;
		$this->dados = $dados;
        $modeloPagina = new \App\site\modelos\Pagina();
		/*Caso um título de página não tenha sido salvo ainda, buscar, no banco de dados, por aquele que pertence a página a qual é chamada pela combinação de controlador e método enviados.*/
		if(empty($this->dados["titulo"])) {$this->dados["titulo"] = $modeloPagina->buscarTitulo($dados["controlador"], $dados["metodo"]);}
    }

	/*Exibir a combinação de seções visuais padrão e selecionadas que formam a página.*/
    public function renderizar(){
        $modeloPagina = new \App\site\modelos\Pagina();
		/*Buscar, no banco de dados, pelo tipo da página que é chamada pela combinação de controlador e método salvos nesta instância.*/
		$tipoPagina = $modeloPagina->buscarTipo($this->dados['controlador'], $this->dados['metodo']);
		/*Caso uma página com o nome selecionado exista, os seus scripts visuais são carregados, o que exibirá as seções visuais que a compôem. Caso contrário, uma mensagem de erro, com o nome de página selecionado, será exibida.*/
        if (file_exists("app/{$tipoPagina}/visuais/{$this->nome}.php")){
            include_once("app/{$tipoPagina}/visuais/incluidos/header.php");
            include_once("app/{$tipoPagina}/visuais/{$this->nome}.php");
            include_once("app/{$tipoPagina}/visuais/incluidos/footer.php");
        }else{
            echo "Erro ao carregar a página: {$this->nome}";
        }
    }

	/*Exibir a página de autenticação para o acesso à área administrativa.*/
    public function rndrzrAutenAdm(){
		include_once("app/adm/visuais/{$this->nome}.php");
    }
}

