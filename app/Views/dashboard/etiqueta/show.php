<?= $this->extend('Layouts/dashboard')?>    

<?= $this->section('contenido') ?>   

    <h1>Etiqueta</h1>
    <div>
      <?php if (isset($etiqueta)): ?>
          
        <?= $etiqueta->titulo ?>
          
      <?php endif ?>   

      
    </div>




<?= $this->endSection() ?>
