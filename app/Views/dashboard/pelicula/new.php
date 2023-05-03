<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Pelicula</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

</head>
<body>
    <form action="/dashboard/pelicula/create" method="post">
        <?= view('dashboard/pelicula/_form', ['op' => 'Crear']); ?>
    </form>

</body>
</html>
