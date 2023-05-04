<?= $this->extend('Layouts/dashboard')?>    

<?= $this->section('contenido') ?>   

    <h1>Listado de Peliculas</h1>
    <div>
    <a href="/dashboard/pelicula/new/">Crear</a>
    <?php if (isset($peliculas)): ?>
        
       <table>
        <tr>
            <th>Titulo </th>
            <th>Descripción</th>
            <th>Opciones</th>
        </tr>
        <?php foreach($peliculas as $key => $value): ?>
                <tr>
                    <td><?= $value->titulo ?></td>
                    <td><?= $value->description ?></td>
                    <td>
                        <a href="/dashboard/pelicula/show/<?= $value->id ?>">Show</a>
                        <a href="/dashboard/pelicula/edit/<?= $value->id ?>">Edit</a>

                        <form action="/dashboard/pelicula/delete/<?= $value->id ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                       
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    <?php endif ?>
            

    </div>

    <?= $this->endSection() ?>  