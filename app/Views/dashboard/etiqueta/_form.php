<label for="titulo">Titulo</label>
<input type="text" id="titulo" name="titulo" placeholder="Titulo" value="<?= old('titulo',isset($etiqueta->titulo) ? $etiqueta->titulo : "")?>">
<label for="categoria">Categoria</label>
<select name="categoria_id" id="categoria_id">
    <option value=""></option>
    <?php foreach($categorias as $categoria) :?>
        <option <?= $categoria->id == old('categoria_id', (isset($etiqueta->categoria_id) ? $etiqueta->categoria_id : "")) ? 'selected' : '' ?> value="<?= $categoria->id ?>"><?= $categoria->titulo ?></option>
    <?php endforeach; ?>
</select>
<button type="submit"><?= $op ?></button>