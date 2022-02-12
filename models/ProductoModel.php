<?php 


class ProductoModel{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
  //Instanciar coneccion static para los controladores
     private $db;
  
  
    public function __construct()
    {
        $this->db =  Database::connect();
    }


    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getCategoria_id(){
		return $this->categoria_id;
	}

	public function setCategoria_id($categoria_id){
		$this->categoria_id = $categoria_id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $this->nombre = $this->db->real_escape_string($nombre);
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function setDescripcion($descripcion){
		$this->descripcion =$this->descripcion = $this->db->real_escape_string($descripcion);
	}

	public function getPrecio(){
		return $this->precio;
	}

	public function setPrecio($precio){
		$this->precio = $this->precio = $this->db->real_escape_string($precio);
	}

	public function getStock(){
		return $this->stock;
	}

	public function setStock($stock){
		$this->stock = $this->stock = $this->db->real_escape_string($stock);
	}

	public function getOferta(){
		return $this->oferta;
	}

	public function setOferta($oferta){
		$this->oferta = $this->oferta = $this->db->real_escape_string($oferta);
	}

	public function getFecha(){
		return $this->fecha;
	}

	public function setFecha($fecha){
		$this->fecha = $fecha;
	}

	public function getImagen(){
		return $this->imagen;
	}

	public function setImagen($imagen){
		$this->imagen = $this->imagen = $this->db->real_escape_string($imagen);
	}


    public function getAll(){
            $productos = $this->db->query("SELECT * FROM productos ORDER BY id ASC");
            return $productos;
    }

	
	//sacar todos los productos segund la categoria
    public function getAllCategory(){
		$sql = "SELECT p.* ,c.nombre AS 'catnombre' FROM productos p "
		     ."INNER JOIN categorias c ON c.id = p.categoria_id "
			 ."WHERE P.categoria_id = {$this->getCategoria_id()} "
			 ."ORDER BY id DESC";
		$productos = $this->db->query($sql);
		return $productos;
}

/**
 * Metodo para listar los productos en la pantalla principal
 */
	public function getRandom($limit){
		$productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
		return $productos;
}

	public function getOne(){
		$producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
		return $producto->fetch_object();
}

    public function save(){

         //interpolacion '{}'
    $sql = "INSERT INTO productos VALUES (null, {$this->getCategoria_id()},'{$this->getNombre()}',
    '{$this->getDescripcion()}',{$this->getPrecio()},{$this->getStock()},null,CURDATE(),'{$this->getImagen()}')";
    $save = $this->db->query($sql);

    /**Detectar errores en la consulta 
    echo $sql;
    echo "<br/>";
    echo $this->db->error;
    die();*/

    $result = false;
    if($save){
        $result = true;
    }
    return $result;
    }


	public function edit(){

		//interpolacion '{}'
   $sql = "UPDATE productos   SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}',
    precio={$this->getPrecio()}, stock= {$this->getStock()}, categoria_id={$this->getCategoria_id()}";
	if($this->getImagen() !=null){
	$sql .= ",imagen='{$this->getImagen()}'";
	}
	$sql .= "WHERE id={$this->getId()};";
   $save = $this->db->query($sql);

   $result = false;
   if($save){
	   $result = true;
   }
   return $result;
   }


	public function delete(){
		$sql =" DELETE FROM productos WHERE id={$this->id}";
		$delete = $this->db->query($sql);

		$result = false;
    if($delete){
        $result = true;
    }
    return $result;
     }

	}