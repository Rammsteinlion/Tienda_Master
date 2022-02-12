<?php 

Class ErrorController{

  public function index(){
        echo "<h1>La pagina que buscas no existe</h1>";
        require_once 'views/Error/error404.php';
    }


}