<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de Web</title>

    <link rel="stylesheet" href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg mb-3">
            <div class="container-fluid">
                <a class="navbar-brand"> Code4 </a>
                <div class=" navbar-collapse">
                    <ul class="navbar-nav">

                        <li class="navbar-item">
                            <a href="#" class="nav-link">Peliculas</a>                        
                        </li>

                    </ul>
                </div>
            </div>            
        </nav>
    <?= view('partials/_session') ?>
    <?= view('partials/_form-error') ?>
    <div class="containter">
        <?= $this->renderSection('contenido') ?>
    </div>    
</body>
</html>