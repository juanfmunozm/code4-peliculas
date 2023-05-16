<label for="titulo">Titulo</label>
<input type="text" id="titulo" name="titulo" placeholder="Titulo" value="<?= old('titulo',isset($pelicula->titulo) ? $pelicula->titulo : "")?>">
<label for="categoria">Categoria</label>
<select name="categoria_id" id="categoria_id">
    <option value=""></option>
    <?php foreach($categorias as $categoria) :?>
        <option <?= $categoria->id == old('categoria_id', (isset($pelicula->categoria_id) ? $pelicula->categoria_id : "")) ? 'selected' : '' ?> value="<?= $categoria->id ?>"><?= $categoria->titulo ?></option>
    <?php endforeach; ?>
</select>

<label for="description">Descripción</label>
<textarea name="description" id="description"> <?= old('description',isset($pelicula->description) ? $pelicula->description : "") ?></textarea>
<button type="submit"><?= $op ?></button>