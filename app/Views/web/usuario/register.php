<?= $this->extend('Layouts/web')?>    

<?= $this->section('contenido') ?>   

<form action="<?= route_to('usuario.register_post') ?> " method="post">
    <label for="usuario">Usuario</label>
    <input type="text" name="usuario" id="usuario" value="<?= old('usuario') ?>">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="<?= old('email') ?>">
    <label for="contrasena">Contraseña</label>
    <input type="password" name="contrasena" id="contrasena">
    <input type="submit" value="Enviar">
</form>
<?= $this->endSection() ?>   