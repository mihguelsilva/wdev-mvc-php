<?php
namespace App\Utils;

class View
{

    /*
      Variaveis padroes da View
     */
    private static $vars = array();

    /*
      Método para iniciar a classe da View
      @param array $view
     */
    public static function init ($vars = array())
    {
        self::$vars = $vars;
    }
    
    /*
      Método responsável por retornar conteúdo de uma view
      @param string $view
      @return string
     */
    private static function getContentView ($view)
    {
        $file = $_SERVER["DOCUMENT_ROOT"] . DS . "resources" . DS . "view" . DS . $view . ".html";

        return file_exists($file) ? file_get_contents($file) : "";
    }
    
    /*
      Método responsável por retornar conteúdo renderizado de uma view
      @param string $view
      @param array (string/numeric)
      @return string
     */
    public static function render ($view, $vars = array())
    {
        // CONTEUDO DA VIEW
        $contentView = self::getContentView($view);

        // UNIR ARRAYS
        $vars = array_merge(self::$vars, $vars);

        // CHAVES DOS ARRAY
        $keys = array_keys($vars);
        $keys = array_map(function ($item) {
            return '{{'.$item.'}}';
        }, $keys);

        // RETORNAR CONTEUDO RENDERIZADO
        return str_replace($keys, array_values($vars), $contentView);
    }
}
?>
