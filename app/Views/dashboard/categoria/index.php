<?= $this->extend('Layouts/dashboard')?>    

<?= $this->section('header') ?>   
<h1>Listado de Categorias</h1>
<?= $this->endSection() ?>  

<?= $this->section('contenido') ?> 
    <div>
    <a href="<?= route_to('test',1); ?>">Test RouteName</a>    
    <a class="btn btn-success mb-2" href="/dashboard/categoria/new/">Crear</a>
    <?php if (isset($categorias)): ?>
        
       <table class="table">
        <tr>
            <th>Titulo </th>
            <th>Opciones</th>
        </tr>
        <?php foreach($categorias as $key => $value): ?>
                <tr>
                    <td><?= $value->titulo ?></td>
                    <td>
                        <a href="/dashboard/categoria/show/<?= $value->id ?>" class="btn btn-primary btn-sm  mb-1">Show</a>
                        <a href="/dashboard/categoria/edit/<?= $value->id ?>" class="btn btn-secondary btn-sm  mb-1">Edit</a>

                        <form action="/dashboard/categoria/delete/<?= $value->id ?>" method="post">
                            <button class="btn btn-danger btn-sm  mb-1" type="submit">Eliminar</button>
                        </form>
                       
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?= $pager->links() ?>
    <?php endif ?>
<?= $this->endSection() ?>   