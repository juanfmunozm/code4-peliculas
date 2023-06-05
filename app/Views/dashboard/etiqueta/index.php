<?= $this->extend('Layouts/dashboard')?>    


<?= $this->section('header') ?>   
<h1>Listado de Etiquetas</h1>
<?= $this->endSection() ?>  

<?= $this->section('contenido') ?>   

   
    <div>
    <a class="btn btn-success mb-2" href="/dashboard/etiqueta/new/">Crear</a>
    <?php if (isset($etiquetas)): ?>
        
       <table class="table table-hover">
        <tr>
            <th>Titulo </th>
            <th>Categoria</th>
        </tr>
        <?php foreach($etiquetas as $key => $value): ?>
                <tr>
                    <td><?= $value->titulo ?></td>
                    <td><?= $value->categoria ?></td>
                    <td>
                        <a href="/dashboard/etiqueta/show/<?= $value->id ?>" class="btn btn-primary btn-sm mb-1">Show</a>
                        <a href="/dashboard/etiqueta/edit/<?= $value->id ?>" class="btn btn-secondary btn-sm  mb-1">Edit</a>
                        <a href="<?= route_to('etiqueta.etiquetas',$value->id)?>" class="btn btn-secondary btn-sm  mb-1">Tags</a>
                        <form action="/dashboard/etiqueta/delete/<?= $value->id ?>" method="post">
                            <button type="submit" class="btn btn-danger btn-sm mb-1">Eliminar</button>
                        </form>
                       
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?= $pager->links() ?>
    <?php endif ?>
            

    </div>
       
    <?= $this->endSection() ?>  