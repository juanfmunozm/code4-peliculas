
<div class="mb-4">
    <label class="form-label" for="titulo">Titulo</label>
    <input type="text" id="titulo" class="form-control" name="titulo" placeholder="Titulo" value="<?= old('titulo',isset($pelicula->titulo) ? $pelicula->titulo : "")?>">
</div>
<div class="mb-4">
    <label for="categoria" class="form-label">Categoria</label>
    <select name="categoria_id" id="categoria_id" class="form-control">
        <option value=""></option>
        <?php foreach($categorias as $categoria) :?>
            <option <?= $categoria->id == old('categoria_id', (isset($pelicula->categoria_id) ? $pelicula->categoria_id : "")) ? 'selected' : '' ?> value="<?= $categoria->id ?>"><?= $categoria->titulo ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="mb-4">
    <label for="description" class="form-label">Descripción</label>
    <textarea name="description" id="description" class="form-control"> <?= old('description',isset($pelicula->description) ? $pelicula->description : "") ?></textarea>
</div>
<div class="mb-4">
    <?php if(isset($pelicula->id)) : ?>
        <label for="imagen" class="form-label">Imagen</label>
        <input type="file" name="imagen" id="imagen" class="form-control">
    <?php endif; ?>
</div>

<button class="btn btn-primary btn-sm " type="submit"><?= $op ?></button>

