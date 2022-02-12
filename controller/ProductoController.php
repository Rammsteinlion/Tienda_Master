<?php 
require_once 'models/ProductoModel.php';

Class ProductoController{

  public function index(){
        
        $producto = new ProductoModel();
        $productos=$producto->getRandom(6);
        //verificar que datos que trae
        //var_dump($productos->num_rows);
        // renderizar vistas 
        include_once 'Views/productos/destacados.php';
    }

    /**vista donde se va ver la lista de productos */

    public function ver(){

      if(isset($_GET['id'])){
        $id = $_GET['id'];

        $producto= new ProductoModel();
        $producto->setId($id);

        $prod = $producto->getOne();
      }
        include_once 'views/Productos/ver.php';
    }

    public function gestion(){
      Utils::isAdmin();
      $producto = new ProductoModel();
      $productos = $producto->getAll();
      include_once 'views/Productos/gestion.php';
    }


    public function crear(){
      Utils::isAdmin();
      include_once 'views/Productos/crear.php';
    }

    public function save(){
      Utils::isAdmin();
      if(isset($_POST)){
        $nombre = isset($_POST['nombre']) ?  $_POST['nombre'] : false;
        $descripcion = isset($_POST['descripcion']) ?  $_POST['descripcion'] : false;
        $precio = isset($_POST['precio']) ?  $_POST['precio'] : false;
        $stock = isset($_POST['stock']) ?  $_POST['stock'] : false;
        $categoria = isset($_POST['categoria']) ?  $_POST['categoria'] : false;
       // $imagen = isset($_POST['imagen']) ?  $_POST['imagen'] : false;

       if($nombre && $descripcion && $precio && $stock && $categoria){
         $producto = new ProductoModel;
          $producto->setNombre($nombre);
          $producto->setDescripcion($descripcion);
          $producto->setPrecio($precio);
          $producto->setStock($stock);
          $producto->setCategoria_id($categoria);

          //Guardar la imagen & comienza metodo para actualizar
        if(isset($_FILES['imagen'])){
            $file = $_FILES['imagen'];
            $filename = $file['name'];
            $mimetype = $file['type'];

          

            if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype== 'image/png' || $mimetype == 'image/gif'){

            // var_dump($file);
              //die(); 

              //comprobar si exite el directorio
              if(!is_dir('uploads/images')){
                //crear el directorio si no existe
                mkdir('uploads/images', 0777, true);
              }

              //mover al directorio
              move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
              $producto->setImagen($filename);
            }
       }

       //metodo de la imagen que servira tanto para guardarla como actualizar(reemplazarla)
              if(isset($_GET['id'])){
                $id = $_GET['id'];
                $producto->setId($id);
                
                $save = $producto->edit();
              }else{
                $save = $producto->save();
              }
          

          if($save){
            $_SESSION['producto'] = "complete";
          }else{
            $_SESSION['producto'] = "failed";
          }
       }else{
        $_SESSION['producto'] = "failed";
       }
      }else{
        $_SESSION['producto'] = "failed";
      }

      header('location:'.base_url.'producto/gestion');
    }


    public function editar(){
      Utils::isAdmin();
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        $edit = true;

        $producto= new ProductoModel();
        $producto->setId($id);

        $pro = $producto->getOne();

        include_once 'views/Productos/crear.php';

      }else{
        header('location:'.base_url.'productos/gestion');
      }

     
    }

    public function eliminar(){
      Utils::isAdmin();

     if(isset($_GET['id'])){
      $id = $_GET['id'];
      $producto = new ProductoModel;
      $producto->setId($id);

      $delete = $producto->delete();

      if($delete){
        $_SESSION['delete'] = 'complete';
      }else{
        $_SESSION['delete'] = 'failed';
      }
     }else{
      $_SESSION['delete'] = 'failed';
     }
     header('location:'.base_url.'producto/gestion');
    }
}