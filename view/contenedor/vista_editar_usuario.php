<h1>EDITAR USUARIO: <?php echo $user->username; ?></h1><br>

<div class="row justify-content-center">
<form id="frm-alumno" action="?c=Web&a=Guardar_Usuario" method="post" enctype="multipart/form-data">
<input type="hidden" name="username" value="<?php echo $user->username; ?>" />

    <div class="form-group">
        <label>Rol</label>
        <select name="roles_id" value="<?php echo $user->roles_id; ?>" class="form-control" placeholder="Ingrese el rol" style="text-align: center">
                <option value="1">Periodista</option>
                <option value="2">Editor</option>
            </select>
    </div>
    
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?php echo $user->nombre; ?>" class="form-control" placeholder="Ingrese el nombre" style="text-align: center"/>
    </div>

    <div class="form-group">
        <label>Password de usuario</label>
        <input type="password" name="password" value="<?php echo $user->password; ?>" class="form-control" placeholder="Ingrese su apellido" style="text-align: center"/>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $user->email; ?>" class="form-control" placeholder="Ingrese el correo" style="text-align: center"/>
    </div>
    
    <hr />
    
    <div class="form-group">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>
</div>