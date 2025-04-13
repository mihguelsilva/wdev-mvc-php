<?php
namespace App\Controller\Pages;
use \App\Utils\View;

class Page
{
    /*
      Método responsável por retornar o topo da página genérica
     */
    private static function getHeader()
    {
        return View::render("pages" . DS . "header");
    }
    /*
      Método responsável por retornar o rodapé da página genérica
     */
    private static function getFooter()
    {
        return View::render("pages" . DS . "footer");
    }
    /*
      Método responsável por retornar conteúdo de página genérica
      @param string $title
      @param string @content
     */
    public static function getPage($title, $content)
    {
        return View::render("pages" . DS . "page", array(
            "title" => $title,
            "header" => self::getHeader(),
            "content" => $content,
            "footer" => self::getFooter()
        ));
    }
}
?>
