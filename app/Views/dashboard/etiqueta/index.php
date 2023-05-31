<?= $this->extend('Layouts/dashboard')?>    

<?= $this->section('contenido') ?>   

    <h1>Listado de Etiquetas</h1>
    <div>
    <a href="/dashboard/etiqueta/new/">Crear</a>
    <?php if (isset($etiquetas)): ?>
        
       <table>
        <tr>
            <th>Titulo </th>
            <th>Categoria</th>
        </tr>
        <?php foreach($etiquetas as $key => $value): ?>
                <tr>
                    <td><?= $value->titulo ?></td>
                    <td><?= $value->categoria ?></td>
                    <td>
                        <a href="/dashboard/etiqueta/show/<?= $value->id ?>">Show</a>
                        <a href="/dashboard/etiqueta/edit/<?= $value->id ?>">Edit</a>
                        <a href="<?= route_to('etiqueta.etiquetas',$value->id)?>">Tags</a>
                        <form action="/dashboard/etiqueta/delete/<?= $value->id ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                       
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?= $pager->links() ?>
    <?php endif ?>
            

    </div>
       
    <?= $this->endSection() ?>  