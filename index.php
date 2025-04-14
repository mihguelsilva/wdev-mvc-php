<?php
define("DS", DIRECTORY_SEPARATOR);
define("URL", "http://wdev.mvc.br/mvc");

require __DIR__ . DS . "vendor" . DS . "autoload.php";

use \App\Http\Router;
use \App\Http\Response;
use \App\Controller\Pages\Home;

$obRouter = new Router(URL);


// ROTA HOME
$obRouter -> get("/", array(function(){
    return Home::getHome();
}
));


$obRouter -> run() -> sendResponse();
?>
