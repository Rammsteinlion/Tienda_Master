<?php


class Utils{

    /**
     * para cerrar una session
     */
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

/**comprueba si un usuario es administrador */
    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header('location:'.base_url);
        }else{
            return true;
        }
    }

    /**comprueba si estamos identificados */
    public static function idIdentity(){
        if(!isset($_SESSION['identity'])){
            header('location:'.base_url);
        }else{
            return true;
        }
    }


    public static function showCategorias(){
        require_once 'models/CategoriaModel.php';
        $categoria = new CategoriaModel();
        $categorias = $categoria->getAll();
        return $categorias;
    }

        public static function statsCarrito(){
            $stats = array(
                'count' =>  0,
                'total' =>  0
            );

            if(isset($_SESSION['carrito'])){
               $stats['count'] = count($_SESSION['carrito']);
               
               foreach($_SESSION['carrito'] as $index => $producto){
                    $stats['total']  += $producto['precio']*$producto['unidades'];
               }
            }

            return $stats;
        }

        public static function showStatus($status){
            switch ($status) {
                case "confirm":
                    $value = 'pendiente';
                    break;
                
                case 'preparation':
                    $value = 'En preparacion';
                    break;

                case 'ready':
                    $value = 'Preparado';
                    break;

                case 'send':
                    $value = 'Pedido Enviado';
                    break;

                default:
                $value = 'Default';
                    break;
            }

            return $value;
        }
}
