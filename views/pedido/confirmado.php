<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido']== 'complete'):?>

<h1>Tu pedido se ha confirmado</h1>
<p>Tu pedido ha sido guardado con exito.
    Al momento de realizar la transferencia bancaria
    a la cuenta 00723723923 bancaria  el pedido sera procesado y enviado. 
</p>

<br>
<?php if(isset($pedido)): ?>
        <h3>Datos del pedido</h3>
        <br>
        Numero del pedido:  <?= $pedido->id?>
        <br>
        Total a pagar:   <?= $pedido->coste?>
        <br>
        Productos: <?= $pedido->id?>
       <br>
       <?php while($producto = $productos->fetch_object()): ?>

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


<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'):?>
    <h1>Tu pedido no se ha podido procesar</h1>
<?php endif;?>