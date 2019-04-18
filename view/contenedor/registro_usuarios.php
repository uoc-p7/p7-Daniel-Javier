<h1>REGISTRAR USUARIOS</h1>

<form id="frm-noticia" action="?c=Web&a=Guardar_usuarios" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label>Nombre de usuario</label>
        <input type="text" name="username" value="<?php echo $user->username; ?>" class="form-control" placeholder="Ingrese su nombre de usuario" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>Rol</label>
            <select name="roles_id" value="<?php echo $user->roles_id; ?>" class="form-control" placeholder="Ingrese el rol" id="exampleFormControlSelect1">
                <option value="1">Periodista</option>
                <option value="2">Editor</option>
            </select>
    </div>
    
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?php echo $user->nombre; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" value="<?php echo $user->password; ?>" class="form-control" placeholder="Ingrese su password" data-validacion-tipo="requerido|min:3" />
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $user->email; ?>" class="form-control" placeholder="Ingrese su correo electronico" data-validacion-tipo="requerido|min:email" />
    </div>

    <div class="text-center">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>


