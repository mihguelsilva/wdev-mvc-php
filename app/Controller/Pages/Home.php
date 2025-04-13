<?php
namespace App\Controller\Pages;
use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home extends Page
{
    /*
      Método responsável por retornar o conteúdo (view) da nossa Home
      *@return string
      Irá retornar o conteúdo HTML para ser imprimido para o usuário
     */
    public static function getHome()
    {
        // NOVA INSTANCIA DA ORGANIZATION
        $obOrganization = new Organization;
        
        // VIEW DA HOME
        $content = View::render("pages" . DS . "home", array(
            "name" => $obOrganization -> name,
            "description" => $obOrganization -> description
        ));

        // VIEW DA PAGE
        return parent::getPage("Home", $content);
    }
}
?>
