<h1>
  <?php foreach($this->categorias->VerCategoriaID($_REQUEST['categoria_id']) as $r):
  echo ucwords($r->categoria_texto);
  endforeach; ?>
</h1><br>

<div class="row justify-content-center" >
<div style="width:60%;">
<?php foreach($this->noticia->ObtenerNoticiaCategoria($_REQUEST['categoria_id']) as $r): ?>

<div class="card mb-3">
  <img src="<?php echo $r->ruta_imagen;?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h1 class="card-title"><?php echo $r->noticia_titulo; ?></h1><br>
    <h3 class="card-text"><?php echo $r->noticia_subtitulo; ?></h3><hr/>
    <p class="card-text"><?php echo $r->noticia_texto; ?></p>
  </div>
</div><br>
<?php endforeach; ?>
</div></div>