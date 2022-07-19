<?php
namespace App\site\modelos;
if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Pagina{

	/*Retornar o 'Tipo' da página no banco de dados. Recebe o controlador e o método utilizados para abrir a página no navegador.*/
    public function buscarTipo($controlador, $metodo){
        $modeloLeitor = new \Site\modelos\auxiliar\ModeloLeitor();
		/*Procurar no banco de dados pelo tipo de uma página com base em sua controladora e método, depois salvar e retornar esse tipo.*/
		$tipoPagina = $modeloLeitor->lerEspecifico('SELECT pag.tipo
                FROM pagina as pag
                WHERE (pag.controlador =:controlador AND pag.metodo =:metodo)',
				array("controlador" => $controlador, "metodo" => $metodo));
		//INFO: O 'tipo' retornado pela função determina se a página com as informações recebidas faz parte da parte pública ('site') ou administrativa ('adm') do site.
        return $tipoPagina;
    }
	
	/*Retornar o 'Titulo' da página no banco de dados. Recebe o controlador e o método utilizados para abrir a página no navegador.*/
	public function buscarTitulo($controlador, $metodo){
		$modeloLeitor = new \Site\modelos\auxiliar\ModeloLeitor();
		/*Procurar no banco de dados pelo título da página que tem o controlador e o método especificados, depois salvar e retornar esse título.*/
		$titulo = $modeloLeitor->lerEspecifico('SELECT pag.titulo
			FROM pagina as pag
			WHERE (pag.controlador =:controlador AND pag.metodo =:metodo)',
			array("controlador" => $controlador, "metodo" => $metodo));
		return $titulo;
	}
}

