<?= $this->extend('Layouts/dashboard')?>    

<?= $this->section('contenido') ?>   

    <h1>Pelicula</h1>
    <div>
      <?php if (isset($pelicula)): ?>
          
        <?= $pelicula->titulo." ".$pelicula->description ?>
          
      <?php endif ?>  
      <ul>
        <?php foreach( $imagenes as $imagen): ?>
          <li><?= $imagen->imagen ?></li>
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
