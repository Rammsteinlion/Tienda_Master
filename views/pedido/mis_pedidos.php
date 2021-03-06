<?php if(isset($gestion)):  ?>
<h1>Gestionar Pedidos</h1>
<?php else: ?>
<h1>Mis Pedidos</h1>
<?php endif;  ?>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Nº Pedido</th>
            <th>Coste</th>
            <th>Fecha</th>
            <th>estado</th>            
        </tr>
    </thead>
    <tbody>
       <?php 
       while($ped = $pedidos->fetch_object()): 
       ?>
        <tr>
            <td>
                <a href="<?=base_url?>pedido/detalle&id=<?=$ped->id?>"><?=$ped->id?></a>
            </td>
            <td>
            <?=$ped->coste?>
            </td>
            <td>
            <?=$ped->fecha?>
            </td>
            <td>
           <?= Utils::showStatus($ped->estado)?>
            </td>
        </tr>
    </tbody>
    <?php endwhile; ?>
</table>