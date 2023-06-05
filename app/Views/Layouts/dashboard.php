<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de Dashboard</title>

    <link rel="stylesheet" href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg mb-3">
        <div class="container-fluid">
            <a class="navbar-brand"> Code4 </a>
            <div class=" navbar-collapse">
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a href="<?= base_url() ?>/dashboard/categoria " class="nav-link">Categorias</a>                        
                    </li>
                    <li class="navbar-item">
                        <a href="<?= base_url() ?>/dashboard/pelicula " class="nav-link">Peliculas</a>                        
                    </li>
                    <li class="navbar-item">
                        <a href="<?= base_url() ?>/dashboard/etiqueta " class="nav-link">Etiquetas</a>                        
                    </li>
                </ul>
            </div>

        </div>
        
    </nav>
    <div class="container">
        <?= view('partials/_session') ?>
        <div class="card">
            <div class="card-header">
            <?= $this->renderSection('header') ?>
            </div>
            <div class="card-body">
                
                <?= view('partials/_form-error') ?>
                <?= $this->renderSection('contenido') ?>
            </div>            
        </div>
    </div>    

    <script src="<?= base_url() ?>/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>