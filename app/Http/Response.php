<?php
namespace App\Http;

class Response
{
    /*
      Código HTTP
      @var integer
     */
    private $httpCode = 200;

    /*
      Cabeçalho do Response
      @var array
     */
    private $headers = array();

    /*
      Tipo de conteúdo que estaremos retornando para o usuário
      @var string
     */
    private $contentType = "text/html";

    /*
      Conteúdo do Response
      @var mixed
     */
    private $content;

    /*
      Método responsável por iniciar a classe e definir valores
      @param integer $httpCode
      @param mixed $content
      @param string $contentType
     */
    public function __construct ($httpCode, $content, $contentType = "text/html")
    {
        $this -> httpCode = $httpCode;
        $this -> content = $content;
        $this -> setContentType($contentType);
    }

    /*
      Método responsável por definir o tipo de conteúdo do Response
      @param string $contentType
     */
    public function setContentType ($contentType)
    {
        $this -> contentType = $contentType;
        $this -> addHeaders("Content-Type", $contentType);
    }

    /*
      Método responsável por adicionar um registro no cabeçalho do response
      @param string $key
      @param string $value
     */
    public function addHeaders($key, $value)
    {
        $this -> headers[$key] = $value;
    }

    public function sendResponse ()
    {
        // ENVIAR CABEÇALHO
        $this -> sendHeaders();
        
        // IMPRIMIR CONTEUDO
        switch ($this -> contentType)
        {
        case "text/html":
            echo $this -> content;
            break;

        default:
            // code
            break;
        }
    }

    /*
      Método responsável por enviar os cabeçalhos do response
     */
    public function sendHeaders ()
    {
        http_response_code($this -> httpCode);

        foreach($this -> headers as $key => $value)
        {
            header($key . ": " . $value);
        }
    }
}
?>
