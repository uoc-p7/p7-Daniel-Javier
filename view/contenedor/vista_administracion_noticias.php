<h1>ADMINISTRACION</h1><br><hr>

<h4>GESTIÓN DE NOTICIAS</h4>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Título noticia</th>
            <th>Subtítulo Noticia</th>
            <th>Editar noticia</th>
            <th>Eliminar noticia</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->noticia->Listar_noticias_admin() as $r): ?>
        <tr>
            <td><?php echo $r->noticia_titulo; ?></td>
            <td><?php echo $r->noticia_subtitulo; ?></td>
            <td>
                <a href="?c=Web&a=Editar_Noticia_Admin&noticia_id=<?php echo $r->noticia_id; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar esta noticia?');" href="?c=Web&a=Eliminarnoticia&noticia_id=<?php echo $r->noticia_id; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 