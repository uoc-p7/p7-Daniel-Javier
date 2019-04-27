<h1>AÑADIR NOTICIAS</h1>

<form id="frm-noticia" action="?c=Web&a=Guardar_noticia" method="post" enctype="multipart/form-data" >
    
    
<div class="form-group">
        <label>Categoría noticia</label>
            <select name="categoria_id" value="<?php echo $notice->categoria_id; ?>" class="form-control" placeholder="Seleccione una categoría">
                <option value=""></option> 
                <option value="1">Actualidad</option>
                <option value="2">Economía</option>
                <option value="3">Deportes</option>
                <option value="4">Sociedad</option>
            </select>
    </div>    
    
    <div class="form-group">    
    <label>Titulo</label>
        <input type="text" name="noticia_titulo" value="<?php echo $notice->noticia_titulo; ?>" class="form-control" placeholder="Introduce un título"  />
    </div>


    <div class="form-group">
    <label>Subtitulo</label>
        <input type="text" name="noticia_subtitulo" value="<?php echo $notice->noticia_subtitulo; ?>" class="form-control" placeholder="Introduce un subtítulo"  />
    </div>

    <div class="form-group">
    <label>Keywords (Introduce las palabras clave separadas por comas)</label>
        <input type="text" name="keyword_texto" value="<?php echo $kw->keyword_texto; ?>" class="form-control" placeholder="Introduce keywords"  />
    </div>


    <div class="form-group">
    <label>Imagen (Opcional)</label>
        <input type="file" id = "ruta_imagen" name="ruta_imagen" accept="image/png, image/jpeg" value="<?php echo $kw->ruta_imagen; ?>" class="form-control" />
    </div>

    <div class="form-group" >
    <label for="texto_noticia">Texto de la noticia</label>
     <textarea name="noticia_texto"  id="noticia_texto" value="<?php echo $notice->noticia_texto; ?>"  rows="12" ></textarea>
    </div>

    <div class="text-center">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>


<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>