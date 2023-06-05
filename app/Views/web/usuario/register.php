<?= $this->extend('Layouts/web')?>    

<?= $this->section('contenido') ?>   

<div class="container" style="max-width:400px">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Register</h1>
        </div>
        <div class="card-body">
            <form action="<?= route_to('usuario.register_post') ?> " method="post">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" value="<?= old('usuario') ?>">
                </div>
                <div class="mb-3">    
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="<?= old('email') ?>">
                </div>
                <div class="mb-3">   
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" class="form-control">
                </div>
                <div class="d-grid">
                    <input type="submit" value="Enviar" class="btn btn-primary btn-sm">
                </div> 
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>   