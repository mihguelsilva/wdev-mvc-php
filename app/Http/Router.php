<?php
namespace App\Http;
use \Closure;
use \Exception;

class Router
{
    /*
      URL completa da aplicação, não apenas a URI (raiz)
      @var string
     */
    private $url = "";

    /*
      Prefixo base para todas as rotas, o que será comum para todas
      @var string
     */
    private $prefix = "";

    /*
      Índice de todas as rotas
      @var array
     */
    private $routes = array();

    /*
      Instância de Request
      @var Request
     */
    private $request;

    /*
      Método responsável por iniciar a classe
      @param string $url
     */
    public function __construct ($url)
    {
        $this -> url = $url;
        $this -> request = new Request();
        $this -> setPrefix();
    }

    /*Método responsável por definir prefixo da nossa aplicação*/
    public function setPrefix()
    {
        // INFORMACOES DA URL ATUAL
        $parseUrl = parse_url($this -> url);

        // DEFINIR PREFIXO
        $this -> prefix = $parseUrl["path"];
    }

    /*
      Método responsável por adicionar uma rota na classe Router
      @param string $method
      @param string $route
      @param array @params
     */
    private function addRoute($method, $route, $params = array())
    {
        // VALIDACAO DOS PARAMS
        foreach ($params as $key => $value)
        {
            if ($value instanceof Closure)
            {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }
        
        // PADRAO PARA VALIDAR URL
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        // ADICIONAR ROTA DENTRO DA CLASSE
        $this -> routes[$patternRoute][$method] = $params;

        echo "<pre>";
        print_r($this);
        echo "</pre>";

    }

    /*
      Método responsável por definir uma rota GET
      @param string $route
      @param array $params
     */
    public function get ($route, $params = array())
    {
        $this -> addRoute("GET", $route, $params);
    }

    public function run ()
    {
        try
        {
            throw new Exception ("Página não encontrada", 404);
        } catch (Exception $e)
        {
            return new Response ($e -> getCode(), $e -> getMessage());
        }
    }
}
?>
