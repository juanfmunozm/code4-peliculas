<label for="titulo">Titulo</label>
<input type="text" id="titulo" name="titulo" placeholder="Titulo" value="<?= isset($categoria['titulo']) ? $categoria['titulo'] : "" ?>">

<button type="submit"><?= $op ?></button>