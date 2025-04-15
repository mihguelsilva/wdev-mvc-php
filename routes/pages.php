<?php
use \App\Http\Response;
use \App\Controller\Pages;

// ROTA HOME
$obRouter -> get("/", array(
    function(){
        return new Response(200, Pages\Home::getHome());
    }
));

// ROTA SOBRE
$obRouter -> get("/sobre", array(
    function(){
        return new Response(200, Pages\Sobre::getSobre());
    }
));
?>
