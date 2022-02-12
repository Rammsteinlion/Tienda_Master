<?php if(isset($editar)): ?>
<h1>Editar Producto</h1>
<?php else: ?>
<h1>Crear Nuevo Producto</h1>
<?php endif; ?>

<form action="<?=base_url?>producto/save" method="POST" enctype="multipart/form-data">
<section class="form-register">
    <h4>Editar Producto</h4>

    <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del producto">

    <textarea class="controls" type="text" name="descripcion" id="descripcion" placeholder="Ingresa la Descripción" cols="30" rows="10"></textarea>

    <input class="controls" type="text" name="precio" id="precio" placeholder="Ingresa Precio">

    <input class="controls" type="number" name="stock" id="stock" placeholder="Ingresa al Stock">
    
    <?php $categorias = Utils::showCategorias(); ?>
    <select class="controls" name="categoria" id="categoria">
    <?php while($cat = $categorias->fetch_object()): ?>
    <option value="<?=$cat->id?>">
        <?=$cat->nombre?>
    </option>
    <?php endwhile; ?>
  </select>

  <input class="controls" type="file" name="imagen" id="imagen" placeholder="Imagen">

    <input class="botons" type="submit" value="Actualizar Producto">
</form>