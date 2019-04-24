

<div class="row">

<?php foreach($this->noticia->ObtenerNoticiaCategoria($_REQUEST['categoria_id']) as $r): ?>

<div class=".col-lg-auto col-centrada"  >
  <br>
  <div class="card" style="width: 18rem;">  
  <div class="card-body">



  <h5 class="card-title"><?php echo $r->noticia_titulo; ?></h5>
  <h6 class="card-subtitle mb-2 text-muted"><?php echo $r->noticia_subtitulo; ?></h6>

    
    <table class="table  ">
    <tbody>    

        <tr>
            <td><?php echo $r->noticia_texto; ?></td>		
        </tr>
        <tr>
            <td><img src="<?php echo $r->ruta_imagen;?>" alt="" /></td>
        </tr>
  
  
        </tbody>
    </table>
    </div> 
    </div> 
</div> 

<?php endforeach; ?>

</div>  