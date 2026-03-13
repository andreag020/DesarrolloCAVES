<h1>Inventario</h1>

<a href="<?php echo site_url('inventario/crear');?>">Nuevo producto</a>

<table border="1">
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Descripción</th>
<th>Cantidad</th>
<th>Precio</th>
<th>Acciones</th>
</tr>

<?php foreach($productos as $p){ ?>

<tr>
<td><?php echo $p->id;?></td>
<td><?php echo $p->nombre;?></td>
<td><?php echo $p->descripcion;?></td>
<td><?php echo $p->cantidad;?></td>
<td><?php echo $p->precio;?></td>

<td>
<a href="<?php echo site_url('inventario/eliminar/'.$p->id);?>">Eliminar</a>
</td>

</tr>

<?php } ?>

</table>