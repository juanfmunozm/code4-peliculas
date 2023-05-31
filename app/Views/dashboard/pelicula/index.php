<?= $this->extend('Layouts/dashboard')?>    

<?= $this->section('contenido') ?>   

    <h1>Listado de Peliculas</h1>
    <div>
    <a href="/dashboard/pelicula/new/">Crear</a>
    <?php

use Config\Pager;

 if (isset($peliculas)): ?>
        
       <table>
        <tr>
            <th>Titulo </th>
            <th>Descripción</th>
            <th>Categoria</th>
            <th>Opciones</th>
        </tr>
        <?php foreach($peliculas as $key => $value): ?>
                <tr>
                    <td><?= $value->titulo ?></td>
                    <td><?= $value->description ?></td>
                    <td><?= $value->categoria ?></td>
                    <td>
                        <a href="/dashboard/pelicula/show/<?= $value->id ?>">Show</a>
                        <a href="/dashboard/pelicula/edit/<?= $value->id ?>">Edit</a>
                        <a href="<?= route_to('pelicula.etiquetas',$value->id)?>">Tags</a>
                        <form action="/dashboard/pelicula/delete/<?= $value->id ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                       
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?= $pager->links() ?>
    <?php endif ?>
            

    </div>
       
    <?= $this->endSection() ?>  