<?= $this->extend('Layouts/dashboard')?>    

<?= $this->section('contenido') ?>   

    <h1>Pelicula</h1>
    <div>
      <?php if (isset($pelicula)): ?>
          
        <?= $pelicula->titulo." ".$pelicula->description ?>
          
      <?php endif ?> 
      <h3>Imágenes</h3>
      <ul>
        <?php foreach( $imagenes as $imagen): ?>
          <li><img src="/uploads/peliculas/<?= $imagen->imagen?>" width="200px">
            <form action="<?= route_to('pelicula.borrar_imagen',$imagen->id) ?>" method="post">  
              <button class="btn btn-primary btn-sm mb-1" type="submit">Borrar</button>
            </form>
            <form action="<?= route_to('pelicula.descargar_imagen',$imagen->id) ?>" method="post">  
              <button class="btn btn-primary btn-sm mb-1" type="submit">Descargar</button>
            </form>
          </li>
        <?php endforeach; ?>  
      </ul> 
      <h3>Etiquetas</h3>
      <?php foreach( $etiquetas as $etiqueta): ?>
        <button data-url="<?= route_to('pelicula.etiqueta_delete',$pelicula->id,$etiqueta->id) ?>" class="delete_etiqueta" ><?= $etiqueta->titulo ?></button>
      <?php endforeach; ?>
      
    </div>
    <script>
      document.querySelectorAll('.delete_etiqueta').forEach((b) => {
          b.onclick = function(event) {             
             fetch(this.getAttribute('data-url'),{
             method:'POST'}
             ).then(res => res.json()).then(
              res => {
              window.location.reload()
              //res => console.log(res)
            })
          };
      });
      
    </script>



<?= $this->endSection() ?>
