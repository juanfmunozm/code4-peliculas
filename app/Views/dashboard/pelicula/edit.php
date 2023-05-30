<?= $this->extend('Layouts/dashboard')?>    

<?= $this->section('contenido') ?>   


    <form enctype="multipart/form-data" action="/dashboard/pelicula/update/<?= $pelicula->id ?>" method="post">
        <?= view('dashboard/pelicula/_form', ['op' => 'Actualizar']); ?>
    </form>

<?= $this->endSection() ?>  