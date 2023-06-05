<?= $this->extend('Layouts/dashboard')?>    


<?= $this->section('header') ?>   
<h1>Listado de Peliculas</h1>
<?= $this->endSection() ?>  

<?= $this->section('contenido') ?>   

    
    <div>
    <a class="btn btn-success mb-2" href="/dashboard/pelicula/new/">Crear</a>
    <?php

use Config\Pager;

 if (isset($peliculas)): ?>
        
       <table class="table table-hover">
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
                        <a href="/dashboard/pelicula/show/<?= $value->id ?>" class="btn btn-primary btn-sm mt-1">Show</a>
                        <a href="/dashboard/pelicula/edit/<?= $value->id ?>" class="btn btn-secondary btn-sm mt-1">Edit</a>
                        <a href="<?= route_to('pelicula.etiquetas',$value->id)?>" class="btn btn-secondary btn-sm mt-1">Tags</a>
                        <form action="/dashboard/pelicula/delete/<?= $value->id ?>" method="post">
                            <button type="submit" class="btn btn-danger btn-sm mt-1" >Eliminar</button>
                        </form>
                       
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?= $pager->links()?>
    <?php endif ?>
            

    </div>
       
    <?= $this->endSection() ?>  