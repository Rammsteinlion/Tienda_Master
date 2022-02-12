<h1>Detalle del pedido</h1>

<?php if(isset($pedido)): ?>

        <?php if(isset($_SESSION['admin'])): ?>        
        <h3>Cambiar estado</h3>   
            <form action="<?=base_url?>pedido/estado" method="POST">
                <input type="hidden" value="<?= $pedido->id?>" name="pedido_id" />
                <select name="estado">
                    <option value="confirm" <?= $pedido->estado == 'confirm' ? 'selected' : ''; ?> >Pendiente</option>
                    <option value="preparation" <?= $pedido->estado == 'preparation' ? 'selected' : ''; ?>>En Preparacion</option>
                    <option value="ready" <?= $pedido->estado == 'ready' ? 'selected' : ''; ?>>Preparado para enviar</option>
                    <option value="send" <?= $pedido->estado == 'send' ? 'selected' : ''; ?>>Enviado</option>
                </select>
                <input type="submit" value="Cambiar estado">
            </form>
            <br>
        <?php endif; ?>

        <h3>Direccion de envio</h3>
        <br>   
        <strong>Provincia:</strong>  <?=$pedido->provincia?></br>
        <strong>Ciudad:</strong>  <?=$pedido->localidad?></br>
        <strong>Direccion:</strong>  <?=$pedido->direccion?></br>
        <hr>
        <h3>Datos del pedido</h3>
        <br>
        <strong>Estado:</strong> <?= Utils::showStatus($pedido->estado)?></br>
        <strong>Numero del pedido:</strong>   <?= $pedido->id?> </br>
        <strong>Total a pagar:</strong>    <?= $pedido->coste?> </br>
        <strong>Productos:</strong>  <?= $pedido->id?>

        

      

        <h1> Listado de Productos</h1>
        <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Preco</th>
            <th>Unidades</th>
            <th></th>
        </tr>
        <tr>
        <?php while($producto = $productos->fetch_object()): ?>
            <td>
         <!--Al añadir al carrito si no tiene imagen carga una por defecto-->
         <?php if($producto->imagen !=null) :?>
                        <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="img_carrito"/>
                        <?php else: ?>
                           <img src="<?= base_url ?>/assets/img/camiseta.png" class="img_carrito"/>
                           <?php endif; ?>
            </td>
            <td><a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a></td>
            <td><?=$producto->precio?></td>
            <td><?=$producto->unidades?></td>
        </tr>
        </table>
        <?php endwhile; ?>
<?php endif; ?>