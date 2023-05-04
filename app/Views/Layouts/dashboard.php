<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de Dashboard</title>
</head>

<body>
    <?= view('partials/_session') ?>
    <?= view('partials/_form-error') ?>
    
    <?= $this->renderSection('contenido') ?>
</body>
</html>