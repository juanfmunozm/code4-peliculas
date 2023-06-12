<?= $this->extend('Layouts/blog')?>
<?= $this->section('contenido')?>
<div class="container">
    <h1>Peliculas por categoria</h1>
    <hr>

    <?php foreach ($peliculas as $p) : ?>
        <div class="card mb-3">
            <div class="card-body">
            <h4><?= $p->titulo ?></h4>
            <span class="btn btn-secondary btn-sm"><?= $p->categoria ?></span>
            
            <p><?= $p->description ?></p>
            <?php if($p->imagen) :?>
                <img class="w-25" src="/uploads/peliculas/<?= $p->imagen?>">
            <?php endif; ?> 
            <span><?= $p->etiquetas ?></span>
            
            <!-- <a class="btn btn-primary" href="blog/<?= $p->id ?>">Ver</a>-->
            <a class="btn btn-primary" href="<?= route_to('blog.pelicula.show',$p->id) ?>">Ver</a>
            </div>
            
        </div>
    <?php endforeach ?>
    <?= $pager->links() ?>
</div>    

<?= $this->endSection('contenido')?>