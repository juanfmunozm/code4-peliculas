<?= $this->extend('Layouts/dashboard')?>    

<?= $this->section('contenido') ?>    
<h1>Listado de Categorias</h1>
    <div>
    <a href="<?= route_to('test',1); ?>">Test RouteName</a>    
    <a href="/dashboard/categoria/new/">Crear</a>
    <?php if (isset($categorias)): ?>
        
       <table>
        <tr>
            <th>Titulo </th>
            <th>Opciones</th>
        </tr>
        <?php foreach($categorias as $key => $value): ?>
                <tr>
                    <td><?= $value->titulo ?></td>
                    <td>
                        <a href="/dashboard/categoria/show/<?= $value->id ?>">Show</a>
                        <a href="/dashboard/categoria/edit/<?= $value->id ?>">Edit</a>

                        <form action="/dashboard/categoria/delete/<?= $value->id ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                       
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?= $pager->links() ?>
    <?php endif ?>
<?= $this->endSection() ?>   