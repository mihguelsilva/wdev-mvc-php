<?php
namespace App\Http;

class Request
{
    /*
      Método HTTP
      @var string
     */
    private $methodHttp;

    /*
      URI da aplicação
      @var string
     */
    private $uri;

    /*
      Cabeçalho da requisição
      @var array
     */
    private $headers = array();

    /*
      Parâmetros da URL, parâmetros do $_GET
      @var array
     */
    private $queryParams = array();

    /*
      Parâmetros do POST
      @var array
     */
    private $postVars = array();

    public function __construct ()
    {
        $this -> methodHttp = $_SERVER["REQUEST_METHOD"] ?? "";
        $this -> uri = $_SERVER["REQUEST_URI"] ?? "";
        $this -> headers = getallheaders();
        $this -> queryParams = $_GET ?? array();
        $this -> postVars = $_POST ?? array();
    }

    public function getHttpMethod()
    {
        return $this -> methodHttp;
    }

    public function getUri()
    {
        return $this -> uri;
    }

    public function getHeaders()
    {
        return $this -> headers;
    }

    public function getQueryParams()
    {
        return $this -> queryParams;
    }

    public function getPostVars()
    {
        return $this -> postVars;
    }
}
?>

