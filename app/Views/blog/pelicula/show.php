<?= $this->extend('Layouts/blog')?>    

<?= $this->section('contenido') ?>   
    
    <div class="container">
      <div class="card">
        <div class="card-body">
          <?php if (isset($pelicula)): ?>
            <h3><?= $pelicula->titulo ?></h3>
            <hr>
            <a href="" class="btn btn-primary"><?= $pelicula->categoria ?></a>
           
            <p><?= $pelicula->description ?></p>   
            
            <h3>Imágenes</h3>
            <div class="d-flex gap2">
              <?php foreach( $imagenes as $imagen): ?>
                <img class="w-25" src="/uploads/peliculas/<?= $imagen->imagen?>">
                
              <?php endforeach; ?>  
              </div> 
            <h3>Etiquetas</h3>
            <?php foreach( $etiquetas as $etiqueta): ?>
              <a class="btn btn-primary" href="<?= route_to('blog.peliculas_por_etiqueta',$etiqueta->id) ?>"><?= $etiqueta->titulo ?></a>
              
            <?php endforeach; ?>
            <?php endif ?>   
        </div>
        

      </div>
    </div>
    
<?= $this->endSection() ?>
