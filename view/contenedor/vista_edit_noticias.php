<h1>LISTADO DE NOTICIAS PENDIENTES</h1><br>

<table class="table table-striped">   
    <thead>
        <tr>
            <th>Título</th>
            <th>Subtítulo</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->noticia->Listarpendientes() as $r): ?>
        <tr>
            <td><?php echo $r->noticia_titulo; ?></td>
            <td><?php echo $r->noticia_subtitulo; ?></td>
            <td>
                <a href="?c=Web&a=Vistaeditarpendiente&noticia_id=<?php echo $r->noticia_id; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar esta noticia?');" href="?c=Web&a=Eliminarnoticia&noticia_id=<?php echo $r->noticia_id; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 

