<?php
define("DS", DIRECTORY_SEPARATOR);
define("URL", "http://wdev.mvc.br/mvc");

require __DIR__ . DS . "vendor" . DS . "autoload.php";

// INCLUIR ROTAS DE PAGINAS
use \App\Http\Router;
use \App\Http\Response;
use \App\Utils\View;

// DEFINE VARIAVEIS DA VIEW
View::init(array(
    "URL" => URL
));

// INICIAR ROTEADOR
$obRouter = new Router(URL);

// INCLUIR ROTAS DE PAGINAS
require __DIR__ . DS . "routes" . DS . "pages.php";

$obRouter -> get ("/pagina/{idPagina}/{acao}", array(
    function ($idPagina, $acao) { return new Response(200, "Página " . $idPagina . " " . $acao ); }
));

// IMPRIME RESPONSE DE ROTAS
$obRouter -> run() -> sendResponse();
?>
