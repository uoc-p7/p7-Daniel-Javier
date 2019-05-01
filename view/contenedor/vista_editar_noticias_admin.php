<h1>EDITAR NOTICIA ID: <?php echo $notice->noticia_id; ?></h1><br>

<div class="row justify-content-center">
<form id="frm-alumno" action="?c=Web&a=Editar_Noticia_Add" method="post" enctype="multipart/form-data">
<input type="hidden" name="noticia_id" value="<?php echo $notice->noticia_id; ?>" />

    <div class="form-group">
        <label>Título Noticia</label>
        <input type="text" name="noticia_titulo" value="<?php echo $notice->noticia_titulo; ?>" class="form-control" placeholder="Ingrese el título de la noticia" style="text-align: center"/>
    </div>

    <div class="form-group">
        <label>Subtítulo Noticia</label>
        <input type="text" name="noticia_subtitulo" value="<?php echo $notice->noticia_subtitulo; ?>" class="form-control" placeholder="Ingrese el subtítulo de la noticia" style="text-align: center"/>
    </div>

    <div class="form-group">
        <label>Texto de la noticia</label>
        <input type="text" name="noticia_texto" value="<?php echo $notice->noticia_texto; ?>" class="form-control" placeholder="Ingrese el texto de la noticia" style="text-align: center"/>
    </div>

    <div class="form-group">
        <label>Categoría</label>
        <select name="categoria_id" value="<?php echo $notice->categoria_id; ?>" class="form-control" placeholder="Ingrese la categoría" style="text-align: center">
                <option value="1">Actualidad</option>
                <option value="2">Economía</option>
                <option value="3">Deportes</option>
                <option value="4">Sociedad</option>

            </select>
    </div>
    
    <div class="form-group">
    <label>Imagen</label><br>
        
        <img src="<?php echo $notice->ruta_imagen; ?>">
        <input type="file" id = "ruta_imagen" name="ruta_imagen" accept="image/png, image/jpeg" value="<?php echo $notice->ruta_imagen; ?>" class="form-control" />
    </div>

    <hr />
    
    <div class="form-group">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>
</div>