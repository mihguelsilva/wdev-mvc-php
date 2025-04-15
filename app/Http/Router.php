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
    }

    /*
      Método responsável por retornar URI, desconsiderando o prefixo
     */
    private function getUri()
    {
        // PUXAR URI DA REQUEST
        $uri = $this -> request -> getUri();

        // SEPARAR URI EM PARTES
        $xUri = strlen($this -> prefix) ? explode($this -> prefix, $uri) : array($uri);

        // RETORNA URI SEM PREFIXO
        return end($xUri);
    }

    /*
      Método responsável por retornar os parâmetros da rota atual
     */
    private function getRoute()
    {
        // URI
        $uri = $this -> getUri();

        // METODO HTTP
        $httpMethod = $this -> request -> getHttpMethod();

        // VALIDAR ROTAS
        foreach ($this -> routes as $patternRoute => $methods)
        {
            // VERIFICA SE A ROTA BATE COM O PADRAO
            if (preg_match($patternRoute, $uri))
            {
                // VERIFICAR METODO
                if ($methods[$httpMethod])
                {
                    // RETORNAR PARAMETROS DA ROTA
                    return $methods[$httpMethod];
                }

                // METODO NAO ENCONTRADO PARA A ROTA REQUISITADA
                throw new Exception("Método não permitido", 405);
            }
        }
        // URL NAO ENCONTRADA
        throw new Exception("Página não encontrada", 404);
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

    /*
      Método responsável por definir uma rota POST
      @param string $route
      @param array $params
     */
    public function post ($route, $params = array())
    {
        $this -> addRoute("POST", $route, $params);
    }

    /*
      Método responsável por definir uma rota PUT
      @param string $route
      @param array $params
     */
    public function put ($route, $params = array())
    {
        $this -> addRoute("PUT", $route, $params);
    }

    /*
      Método responsável por definir uma rota DELETE
      @param string $route
      @param array $params
     */
    public function delete ($route, $params = array())
    {
        $this -> addRoute("DELETE", $route, $params);
    }

    public function run ()
    {
        try
        {
            $route = $this -> getRoute();

            if ((!isset($route['controller'])))
            {
                throw new Exception("A URL não pôde ser processada", 500);
            }

            // ARGUMENTOS DA FUNCAO
            $args = array();

            return call_user_func_array($route['controller'], $args);
            
        } catch (Exception $e)
        {
            return new Response ($e -> getCode(), $e -> getMessage());
        }
    }
}
?>
