<?php

require_once 'models/ProductoModel.php';

class CarritoController
{

    public function index()
    {
    if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >=1 ){
         //array del carrito
       $carrito = $_SESSION['carrito'];
        }else{
             //carrito sera un array vacio
       $carrito = array();
        }
       
       include_once 'views/carrito/index.php';
       
    }


    public function add()
    {
        //Reccoger la url del producto
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            header('location:'.base_url);
        }

        if (isset($_SESSION['carrito'])) {
            $conter = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $conter++;
                }
            }
        }

        if(!isset($conter) || $conter == 0 ){
        /*/codigo sql para añadir un producto al carritos
                conseguir producto
            */
        $producto = new ProductoModel();
        $producto->setId($producto_id);
        $producto = $producto->getOne();

        //Añadir al carrito
        if (is_object($producto)) {
            $_SESSION['carrito'][] = array(
                "id_producto" => $producto->id,
                "precio"      => $producto->precio,
                "unidades"    => 1,
                "producto"    =>  $producto
            );
        }
    }
        header("location:".base_url."carrito/index");
    }

    public function up()
    {
        if(isset($_GET['index'])){
            $index=$_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        header("location:".base_url."carrito/index");

    }

    public function down()
    {
        if(isset($_GET['index'])){
            $index=$_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            if($_SESSION['carrito'][$index]['unidades'] == 0){
                unset($_SESSION['carrito'][$index]);
            }
        }
        header("location:".base_url."carrito/index");

    }


    public function delete()
    {
        if(isset($_GET['index'])){
            $index=$_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header("location:".base_url."carrito/index");

    }

    //Eliminar lo del carrito

    public function delete_all()
    {
        unset($_SESSION['carrito']);
        header("location:".base_url."carrito/index");
    }
}
