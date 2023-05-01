<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

</head>
<body>
    <h1>Listado de Pelliculas</h1>
    <div>
    <a href="/pelicula/new/">Crear</a>
    <?php if (isset($peliculas)): ?>
        
       <table>
        <tr>
            <th>Titulo </th>
            <th>Descripción</th>
            <th>Opciones</th>
        </tr>
        <?php foreach($peliculas as $key => $value): ?>
                <tr>
                    <td><?= $value['titulo'] ?></td>
                    <td><?= $value['description'] ?></td>
                    <td>
                        <a href="/pelicula/show/<?= $value['id'] ?>">Show</a>
                        <a href="/pelicula/edit/<?= $value['id'] ?>">Edit</a>

                        <form action="/pelicula/delete/<?= $value['id'] ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                       
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    <?php endif ?>
            

        

    
    

    </div>


</body>
</html>
