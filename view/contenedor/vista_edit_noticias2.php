<h1>EDITAR NOTICIAS PENDIENTES</h1><br>
<h2><?php echo $notice->noticia_titulo; ?></h2><br>

<div class="row justify-content-center" >
<form action="?c=Web&a=Actualizar_noticia" method="post" enctype="multipart/form-data">
<input type="hidden" name="noticia_id" value="<?php echo $notice->noticia_id; ?>" />    
    
    <div class="form-group">
        <label>Título</label>
        <input type="text" name="noticia_titulo" value="<?php echo $notice->noticia_titulo; ?>" class="form-control" placeholder="Ingrese el título" style="text-align: center" />
    </div>

    <div class="form-group">
        <label>Subtítulo</label>
        <input type="text" name="noticia_subtitulo" value="<?php echo $notice->noticia_subtitulo; ?>" class="form-control" placeholder="Ingrese el subtítulo" style="text-align: center" />
    </div>

    <div class="form-group">
        <label>Texto</label>
        <input type="text" name="noticia_texto" value="<?php echo $notice->noticia_texto; ?>" class="form-control" placeholder="Ingrese el texto de la noticia" style="text-align: center" />
    </div>

    <div class="form-group">
    <label>Imagen</label><br>
        
        <img src="<?php echo $notice->ruta_imagen; ?>">
        <input type="file" id = "ruta_imagen" name="ruta_imagen" accept="image/png, image/jpeg" value="<?php echo $notice->ruta_imagen; ?>" class="form-control" />
    </div>
    <hr/>
    <div class="form-group">
        <button class="btn btn-success">Actualizar y Subir a Web</button>
    </div>
</form>
</div>