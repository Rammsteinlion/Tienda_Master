<?php 
require_once 'models/CategoriaModel.php';
require_once 'models/ProductoModel.php';

Class CategoriaController{

  public function index(){
    Utils::isAdmin();
    $categoria = new CategoriaModel();
    $categorias = $categoria->getAll();

        require_once 'views/Categorias/index.php';
    }

    //ver categorias segun id.
    public function ver(){
      if(isset($_GET['id'])){
       //var_dump($_GET['id']);
       $id = $_GET['id'];

       //Conseguir la categoria
       $categoria = new CategoriaModel();
       $categoria->setId($id); // -> setear el id que llega por la URL,
       $categoria = $categoria->getOne();

       //conseguir Productos
       $producto = new ProductoModel();
       $producto->setCategoria_id($id);
       $productos = $producto->getAllCategory(); //->saca todos los productos de una categoria
       //var_dump($producto->getAllCategory());

      }

      require_once 'views/Categorias/ver.php';
    }


    public function crear(){
      Utils::isAdmin();
      require_once 'views/Categorias/crear.php';
    }

    public function save(){
      Utils::isAdmin();

      if(isset($_POST) && isset($_POST['nombre'])){

        
      //guardar la categoria
      $categoria = new CategoriaModel();
      $categoria->setNombre($_POST['nombre']);
      $categoria->save();

      }

      header('location:'.base_url."categoria/index");
    }


}