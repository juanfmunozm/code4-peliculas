<label for="titulo">Titulo</label>
<input type="text" id="titulo" name="titulo" placeholder="Titulo" value="<?= old('titulo',isset($pelicula->titulo) ? $pelicula->titulo : "")?>">
<label for="description">Descripción</label>
<textarea name="description" id="description"> <?= old('description',isset($pelicula->description) ? $pelicula->description : "") ?></textarea>
<button type="submit"><?= $op ?></button>