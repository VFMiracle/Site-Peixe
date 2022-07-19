<?php
session_start();
if(!isset($_SESSION["carrinho"])) {$_SESSION["carrinho"] = [];}
//OBS: Esta função impede que a saída dos scripts PHP do projeto seja diretamente enviada para a página. Provavelmente, já que este código veio de outro projeto, isso é feito para garantir que as saídas sejam organizadas e modificadas corretamente antes de serem exibidas na página.
ob_start();

$url = "";
$urlAdm = "";
unset($_GET["url"]);
//Se a porta do servidor for diferente de 80, a porta correta é adicionada à URL que abre o site. Caso contrário, a URL pura é utilizada.
if($_SERVER["SERVER_PORT"] != 80){
	$url = "http://127.0.0.1:" .$_SERVER["SERVER_PORT"] ."/SitePeixe/";
	$urlAdm = "http://127.0.0.1:" .$_SERVER["SERVER_PORT"] ."/SitePeixe/adm/";
}
else{
	$url = "http://127.0.0.1/SitePeixe/";
	$urlAdm = "http://127.0.0.1/SitePeixe/adm/";
}

//INFO: Definir constantes dos links de acesso, respectivamente, à seção de usuários do site e à seção administrativa do site. 
define("URL", $url);
define("URL_ADM", $urlAdm);

//INFO: Definir constantes do controlador padrão, da página de erro padrão e dos métodos padrão de cada controlador do site.
define("CONTROLADOR", "Inicio");
define("METODO", array(
	"Inicio" => "index",
	"Informacao" => "contato",
	"Loja" => "principal",
	"Usuario" => "perfil",
));
define("ERRO404", "Erro404");

//INFO: Definir constantes dos dados de acesso ao banco de dados.
define("HOSPEDEIRO", "localhost");
define("ACESSO_USUARIO", "root");
define("SENHA", "");
define("NOME_BD", "site peixe");

function requisitarClasse($nomeCmpltClasse) {
	$diretorios = array(
		"Configuracao",
		"App\Site\Controladores",
		"App\Site\Controladores\Base",
		"App\Site\Modelos",
		"App\Site\Modelos\Auxiliar",
		"App\Site\Visuais"
	);
	$partesNomeClasse = explode("\\", $nomeCmpltClasse. ".php");
	$nomeArquivo = $partesNomeClasse[sizeof($partesNomeClasse) - 1];
	//Buscar, nos diretórios do site, pelo arquivo que contém a classe, e requeri-lo.
	foreach ($diretorios as $diretorio) {
		$caminhoArquivo = $diretorio. "\\". $nomeArquivo;
		//Caso um script com o caminho especificado exista, ele é requerido e o loop é finalizado.
		if (file_exists($caminhoArquivo)) {
			require($caminhoArquivo);
			break;
		}
	}
}

//OBS: Esta função faz uma chamada à função com o nome especificado sempre que um objeto de uma classe que não existe nos arquivos já carregados, tentar ser criado. O propósito dela é chamar uma função que requisite o arquivo que contém a classe desse objeto.
spl_autoload_register("requisitarClasse");
