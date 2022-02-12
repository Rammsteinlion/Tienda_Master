<h1>Gestionar Categoria</h1>


<a class="button" href="<?=base_url?>categoria/crear">
Crear Categoria
</a>

<div id="main-container">
		<table>
			<thead>
				<tr>
					<th>Id</th>
                    <th>Nombre</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tr>
            <?php while($cat = $categorias->fetch_object()): ?>
                <th scope="row"><?= $cat->id?></th>
                <td><?= $cat->nombre?></td>
				<td>
					<input  id="confirmar" type="button" value="Editar">
					<input id="confirmar-e" type="submit" value="Eliminar">
				</td>
			</tr>
            <?php endwhile; ?>
		</table>
	</div>
   
    

