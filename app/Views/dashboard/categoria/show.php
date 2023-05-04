<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar Categoria</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

</head>
<body>
    <h1>Categoria</h1>
    <div>
      <?php if (isset($categoria)): ?>
          
        <?= $categoria->titulo ?>
          
      <?php endif ?>            
    </div>


</body>
</html>
