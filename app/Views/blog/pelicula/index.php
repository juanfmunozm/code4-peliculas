<?= $this->extend('Layouts/blog')?>
<?= $this->section('contenido')?>
<div class="container">
    <h1>Peliculas</h1>
    <hr>

    <div class="card my-3 text-bg-primary">
        <div class="card-body">
        <form  method="get" >
            <div class="d-flex gap-2">
                <select name="categoria_id" id="categoria_id" class="form-control flex-grow-1" >                
                    <option value="">Categoria</option>
                    <?php foreach($categorias as $categoria) : ?> 
                        <option <?= $categoria_id == $categoria->id ? 'selected' : ''  ?> value="<?= $categoria->id ?>"><?= $categoria->titulo ?></option>                    
                    <?php endforeach ?>
                </select>
                <select name="etiqueta_id" id="etiqueta_id" class="form-control">
                    <option value="">Etiqueta</option>
                    <?php foreach($etiquetas as $etiqueta) : ?> 
                        <option <?= $etiqueta_id == $etiqueta->id ? 'selected' : ''  ?> value="<?= $etiqueta->id ?>"><?= $etiqueta->titulo ?></option>                            
                    <?php endforeach ?>   
                </select>
            </div>
            <div class="d-flex gap-2 mt-2">
                <input placeholder="Buscar..." type="text" name="buscar" class="form-control" value="<?= $buscar != "" ? $buscar : '' ?>">
                <input type="submit" class="btn btn-secondary" value="Enviar" >
                <a class="btn btn-primary" style="width:150px" href="<?= route_to('blog.pelicula.index') ?>">Limpiar filtro </a>
            </div>
        </form>
        </div>
    </div>
    

    <?php foreach ($peliculas as $p) : ?>
        <div class="card mb-3">
            <div class="card-body">
            <h4><?= $p->titulo ?></h4>
            <a class="btn btn-secondary btn-sm" href="<?= route_to('blog.peliculas_por_categoria',$p->categoria_id) ?>"><?= $p->categoria ?></a>
            
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

<script>
    document.querySelector('#categoria_id').addEventListener('change',() =>{
        fetch('/blog/etiquetas_por_categoria/'+document.querySelector('#categoria_id').value,
         {
            method: "get",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            }

        }).then(res => res.json())
        .then(res => {
            var etiquetas = '<option value="">Etiquetas</option>';
            res.forEach((etiqueta)=>{
                    etiquetas += ` <option value="${etiqueta.id}">${etiqueta.titulo}</option> `
                }
            )
            document.querySelector('#etiqueta_id').innerHTML = etiquetas
        })
    })
</script>
<?= $this->endSection('contenido')?>