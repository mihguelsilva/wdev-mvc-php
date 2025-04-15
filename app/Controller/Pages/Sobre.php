<?php
namespace App\Controller\Pages;
use \App\Utils\View;

class Sobre extends Page
{
    public static function getSobre() {
    $content = View::render("pages" . DS . "sobre", array(
        "author" => "WDEV - Canal do Youtube",
        "student" => "Mihguel Da Silva Santos Tavares De Araujo",
        "year" => "2025",
        "study" => "Estrutura MVC (Model, View, Controller) com PHP"
    ));

    return parent::getPage("Sobre", $content);
    }  
}
?>
