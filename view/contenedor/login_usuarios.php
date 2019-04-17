<h1>INICIAR SESIÓN</h1>

<form id="frm-alumno" action="?c=Web&a=Iniciar_sesion" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label>Nombre de usuario</label>
        <input type="text" name="username" value="<?php echo $user->username; ?>" class="form-control" placeholder="Ingrese su nombre de usuario" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" value="<?php echo $user->password; ?>" class="form-control" placeholder="Ingrese su password" data-validacion-tipo="requerido|min:3" />
    </div>

    <div class="text-center">
        <button class="btn btn-success">Acceder</button>
    </div>
</form>