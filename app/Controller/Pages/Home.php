<?php
namespace App\Controller\Pages;
use \App\Utils\View;

class Home extends Page
{
    /*
      Método responsável por retornar o conteúdo (view) da nossa Home
      *@return string
      Irá retornar o conteúdo HTML para ser imprimido para o usuário
     */
    public static function getHome()
    {
        // VIEW DA HOME
        $content = View::render("pages" . DS . "home", array(
            "name" => "WDEV - MVC em PHP",
            "description" => "Canal do Youtube: https://youtube.com.br/wdevoficial"
        ));

        // VIEW DA PAGE
        return parent::getPage("Home", $content);
    }
}
?>
