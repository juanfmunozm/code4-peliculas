<div class="mb-4">
    <label for="titulo" class="form-label">Titulo</label>
    <input type="text" id="titulo" class="form-control" name="titulo" placeholder="Titulo" value="<?= old('titulo',isset($etiqueta->titulo) ? $etiqueta->titulo : "")?>">

</div>   
<div class="mb-4"> 
    <label for="categoria" class="form-label">Categoria</label>
    <select name="categoria_id" id="categoria_id" class="form-control">
        <option value=""></option>
        <?php foreach($categorias as $categoria) :?>
            <option <?= $categoria->id == old('categoria_id', (isset($etiqueta->categoria_id) ? $etiqueta->categoria_id : "")) ? 'selected' : '' ?> value="<?= $categoria->id ?>"><?= $categoria->titulo ?></option>
        <?php endforeach; ?>
    </select>

</div>

<button class="btn btn-primary btn-sm " type="submit"><?= $op ?></button>