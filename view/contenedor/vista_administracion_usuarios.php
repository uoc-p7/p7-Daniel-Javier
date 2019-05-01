<h1>ADMINISTRACION</h1><br>

<h4>GESTIÓN DE USUARIOS</h4><br>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Rol</th>
            <th>Nombre de usuario</th>
            <th>Editar usuario</th>
            <th>Eliminar usuario</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->usuario->Listar_usuarios() as $r): ?>
        <tr>
            <td><?php echo $r->roles_descripcion; ?></td>
            <td><?php echo $r->username; ?></td>
            <td>
                <a href="?c=Web&a=Editar_Usuario&username=<?php echo $r->username; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este usuario?');" href="?c=Web&a=Eliminar_Usuario&username=<?php echo $r->username; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 

