<?= $this->extend('Layouts/web')?>    

<?= $this->section('contenido') ?>   
<?= view('partials/_form-error') ?>

<div class="container" style="max-width:400px">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Login</h1>
        </div>
        <div class="card-body">
        <form action="<?= route_to('usuario.login_post') ?> " method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Usuario/Email</label>
            <input type="text" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>  
            <input type="password" name="contrasena" id="contrasena" class="form-control">
        </div>    
        <div class="d-grid">
            <input class="btn btn-primary btn-sm" type="submit" value="Enviar">
        </div>                
        </form>
        </div>
    </div>
    
</div>
<?= $this->endSection() ?>   