<?php if(isset($_SESSION['identity'])): ?>

<h1>Realiza Pedido</h1>
<p>
<a class="button" href="<?php echo base_url?>carrito/index">Productos y Precios del Pedido</a>
</p>

<h3>Direccion de envio:</h3>
<form action="<?=base_url?>pedido/add" method="post">
    <label for="provincia">Provincia</label>
    <input type="text" name="provincia" id="" required>

    <label for="ciudad">Ciudad</label>
    <input type="text" name="localidad" id="" required>

    <label for="direccion">Direccion</label>
    <input type="text" name="direccion" id="" required>

    <input type="submit" value="Confirmar Pedido">
</form>


<?php else: ?>
 <h1>Necesitas estar identificado</h1>
 <p>Debes registrarte primero para realizar alguna compra</p>
<?php endif;?>