<div class="mb-3">
    <label for="titulo" class="form-label">Titulo</label>
    <input type="text" id="titulo" class="form-control" name="titulo" placeholder="Titulo" value="<?= old('titulo',isset($categoria->titulo) ? $categoria->titulo : "")?>">
</div>

<button class="btn btn-primary btn-sm " type="submit"><?= $op ?></button>