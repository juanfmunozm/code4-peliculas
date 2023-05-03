<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

</head>
<body>
    <?= view('partials/_session') ?>
    <?= session('user') ?>
    <h1>Listado de Categorias</h1>
    <div>
    <a href="<?= route_to('test',1); ?>">Test RouteName</a>    
    <a href="/dashboard/categoria/new/">Crear</a>
    <?php if (isset($categorias)): ?>
        
       <table>
        <tr>
            <th>Titulo </th>
            <th>Opciones</th>
        </tr>
        <?php foreach($categorias as $key => $value): ?>
                <tr>
                    <td><?= $value['titulo'] ?></td>
                    <td>
                        <a href="/dashboard/categoria/show/<?= $value['id'] ?>">Show</a>
                        <a href="/dashboard/categoria/edit/<?= $value['id'] ?>">Edit</a>

                        <form action="/dashboard/categoria/delete/<?= $value['id'] ?>" method="post">
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
