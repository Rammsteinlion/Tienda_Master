<h1>Gestionar Productos</h1>


<a class="button" href="<?=base_url?>producto/crear">
Crear Producto
</a>

<!--/producto--->
<?php 
if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete') :?>
    <script> 
    swal({
  title: "Feliciades!",
  text: "Producto registrado con exito!",
  icon: "success",
  button: "Aceptar!",
        });
 </script>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
    <script> 
    swal({
  title: "Error!",
  text: "Error al registrar el producto!",
  icon: "warning",
  dangerMode: true,
  button: "Aceptar!",
        });
 </script>
<?php endif; ?>
<?php Utils::deleteSession('producto') ?>

<!--/Elimindar--->
<?php 
if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') :?>
        <script> 
        swal({
        title: "Feliciades!",
        text: "Producto Eliminado con exito!",
        icon: "success",
        button: "Aceptar!",
            });
        </script> 
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <script> 
    swal({
  title: "Error!",
  text: "Error al Eliminar el Producto!",
  icon: "warning",
  dangerMode: true,
  button: "Aceptar!",
        });
 </script>
<?php endif; ?>
<?php Utils::deleteSession('delete') ?>

<div id="main-container">
		<table>
			<thead>
				<tr>
					<th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tr>
            <?php while($pro = $productos->fetch_object()): ?>
                <td><?= $pro->id?></td>
                <td><?= $pro->nombre?></td>
                <td><?= $pro->precio?></td>
                <td><?= $pro->stock?></td>
				<td>
				<a href="<?php echo base_url?>producto/editar&id=<?=$pro->id?>"    class="button button-gestion button-orange" >Editar</a>
				<a href="<?php echo base_url?>producto/eliminar&id=<?=$pro->id?>"  class="button button-gestion button-red" >Eliminar</a>
				</td>
			</tr>
            <?php endwhile; ?>
		</table>
	</div>
   
    