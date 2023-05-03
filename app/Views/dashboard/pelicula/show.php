<?= $this->extend('Layouts/dashboard')?>    

<?= $this->section('contenido') ?>   

    <h1>Pelicula</h1>
    <div>
      <?php if (isset($pelicula)): ?>
          
        <?= $pelicula['titulo']." ".$pelicula['description'] ?>
          
      <?php endif ?>            
    </div>

<?= $this->endSection() ?>
