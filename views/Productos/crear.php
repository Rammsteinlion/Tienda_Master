<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
    <h1><strong>Editar Producto </strong>  <?= $pro->nombre?></h1>
        <?php $url_action = base_url."producto/save&id=".$pro->id; ?>
    <?php else: ?>
    <h1><strong>Crear Nuevo Producto</strong></h1>
    <?php $url_action = base_url."producto/save"; ?>
    <?php endif; ?>


<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
<section class="form-register">
    <h4>Formulario Productos</h4>

    <small>Nombre</small>
    <input value="<?= isset($pro) && is_object($pro) ? $pro->nombre : ''?>" class="controls" type="text" name="nombre" id="nombre">

      <small>Descripción</small>
    <textarea class="controls" type="text" name="descripcion" id="descripcion" cols="30" rows="10" placeholder="goals">
    <?= isset($pro) && is_object($pro) ? $pro->descripcion : ''?>
     </textarea>

     <small>Precio</small>
    <input value="<?= isset($pro) && is_object($pro) ? $pro->precio : ''?>"  class="controls" type="text" name="precio" id="precio" placeholder="Ingresa Precio">

    <small>Stock</small>
    <input value="<?= isset($pro) && is_object($pro) ? $pro->stock : ''?>" class="controls" type="number" name="stock" id="stock" placeholder="Ingresa al Stock">
    
    <small>Categoria</small>
    <?php $categorias = Utils::showCategorias(); ?>
    <select class="controls" name="categoria" id="categoria">
    <?php while($cat = $categorias->fetch_object()): ?>
    <option value="<?=$cat->id?>" <?= isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : '';?>>
        <?=$cat->nombre?>
    </option>
    <?php endwhile; ?>
  </select>

  <small>Seleccionar foto</small>
  <?php  if(isset($pro) && is_object($pro) && !empty($pro->imagen)) :?>
    <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" class="thumb"/>
  <?php endif; ?>
  <input class="controls" type="file" name="imagen" id="imagen" placeholder="Imagen">

    <input class="botons" type="submit" value="Registrar Producto">
</form>