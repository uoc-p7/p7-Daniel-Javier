<h1>EDITAR NOTICIAS PENDIENTES</h1>
<h2><?php echo $notice->noticia_titulo; ?></h2>
<h2>ID Noticia: <?php echo $notice->noticia_id; ?></h2>

<form action="?c=Web&a=Actualizar_noticia" method="post" enctype="multipart/form-data">
<input type="hidden" name="noticia_id" value="<?php echo $notice->noticia_id; ?>" />    
    
    <div class="form-group">
        <label>Título</label>
        <input type="text" name="noticia_titulo" value="<?php echo $notice->noticia_titulo; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
    </div>

    <div class="form-group">
        <label>Subtítulo</label>
        <input type="text" name="noticia_subtitulo" value="<?php echo $notice->noticia_subtitulo; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
    </div>

    <div class="form-group">
        <label>Texto</label>
        <input type="text" name="noticia_texto" value="<?php echo $notice->noticia_texto; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
    </div>

    <div class="form-group">
    <label>Imagen</label><br>
        
        <img src="<?php echo $notice->ruta_imagen; ?>">
        <input type="file" id = "ruta_imagen" name="ruta_imagen" accept="image/png, image/jpeg" value="<?php echo $notice->ruta_imagen; ?>" class="form-control" />
    </div>
        
    <div class="text-right">
        <button class="btn btn-success">Actualizar y Subir a Web</button>
    </div>
</form>