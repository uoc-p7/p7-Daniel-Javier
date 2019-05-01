<h1>INICIAR SESIÓN</h1><br>


<div class="row justify-content-center">
<form action="?c=Web&a=Iniciar_sesion" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label>Nombre de usuario</label>
        <input type="text" name="username" value="<?php echo $user->username; ?>" class="form-control" placeholder="Ingrese su username" style="text-align: center"  />
    </div>
    
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" value="<?php echo $user->password; ?>" class="form-control" placeholder="Ingrese su password" style="text-align: center" />
    </div>
    <hr/>
    <div class="text-center">
        <button class="btn btn-success">Acceder</button>
    </div>
</form>
</div>
