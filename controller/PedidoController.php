<?php 
require_once 'models/PedidoModel.php';
Class PedidoController{

  public function hacer(){        
      require_once 'views/pedido/hacer.php';
    }

    public function add(){
      if(isset($_SESSION['identity'])){
        $usuario_id = $_SESSION['identity']->id;
        $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
        $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

        //pasar la informacion del coste
        $stats = Utils::statsCarrito();
        $coste = $stats['total'];
        
        if($provincia & $localidad & $direccion){
          //guardar informacion
         $pedido= new PedidoModel();
         $pedido->setUsuario_id($usuario_id);
          $pedido->setProvincia($provincia);
          $pedido->setLocalidad($localidad);
          $pedido->setDireccion($direccion);
          $pedido->setCoste($coste);

          $save = $pedido->save();

          //Guardar linea pedido relacion en la linea y el producto
          $save_linea = $pedido->save_linea();

          if($save && $save_linea){
            $_SESSION['pedido'] = 'complete';
          }else{
            $_SESSION['pedido'] = 'failed';
          }
        }else{
          $_SESSION['pedido'] = 'failed';
        }
        header('location:'.base_url.'pedido/confirmado');
      }else{
        //rediriguir al index
        header("location:" .base_url);
      }
    }

    public function confirmado(){
      if(isset($_SESSION["identity"])){
        $identity = $_SESSION['identity'];
        $pedido = new PedidoModel();
        $pedido->setUsuario_id($identity->id);
        $pedido = $pedido->getOneByUser();

        $pedido_productos = new PedidoModel();
        $productos = $pedido_productos->getProductoByPedido($pedido->id);
      }
       include_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos(){
      Utils::idIdentity();
      $usuario_id = $_SESSION['identity']->id;
      $pedido = new PedidoModel();
      
      //sacar los pedidos del usuario
      $pedido->setUsuario_id($usuario_id);
      $pedidos= $pedido->getAllbyUser();
      
      include_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle(){
      Utils::idIdentity();

      if(isset($_GET['id'])){

        $id = $_GET['id'];

        //Sacar el pedido
        $pedido = new PedidoModel();
        $pedido->setId($id);
        $pedido = $pedido->getOne();

        //sacar los productos
        $pedido_productos = new PedidoModel();
        $productos = $pedido_productos->getProductoByPedido($id);        

        include_once 'views/pedido/detalle.php';
      }else{
        header('location:'.base_url.'pedido/mis_pedidos');
      }     
    }

    public function gestion(){
      Utils::isAdmin();
      $gestion = true;

      $pedido = new PedidoModel();
      $pedidos = $pedido->getAll();

      include_once 'views/pedido/mis_pedidos.php';
    }

    public function estado (){
      Utils::isAdmin();
      if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
        //datos del formulario
        $id  = $_POST['pedido_id'];
        $estado = $_POST['estado'];

        //update del pedido
        $pedido = new PedidoModel();
        $pedido->setId($id);
        $pedido->setEstado($estado);
        $pedido->updateOne();

        header("location".base_url.'pedido/detalle&id='.$id);
      }else{
        header("location".base_url);
      }

    }
    
}