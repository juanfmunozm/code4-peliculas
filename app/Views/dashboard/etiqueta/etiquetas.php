<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>

<form action="" method="post">
    <label for="categoria_id">Categorias</label>
    <select name="categoria_id" id="categoria_id">
        <option value=""></option>
        <?php foreach($categorias as $categoria) :?>
            <option <?=  $categoria->id != $categoria_id ? '' : 'selected' ?> value="<?= $categoria->id ?>"><?= $categoria->titulo ?></option>
        <?php endforeach; ?>
    </select>
    <label for="etiqueta_id">Etiquetas</label>
    <select name="etiqueta_id" id="etiqueta_id">
        <option value=""></option>
        <?php foreach($etiquetas as $etiqueta) :?>
            <option  value="<?= $etiqueta->id ?>"><?= $etiqueta->titulo ?></option>
        <?php endforeach; ?>
    </select>


    <button type="submit" id="buttonSend">Enviar</button>

</form>

<script>
    function disableButton(){
        //if(document.querySelector('[name=etiqueta_id]').value == "")
        if(document.querySelector('#etiqueta_id').value == ""){
            document.querySelector('#buttonSend').setAttribute('disabled','disabled');
        }
        else{
            document.querySelector('#buttonSend').removeAttribute('disabled');
        }
    }
    document.querySelector('#etiqueta_id').onchange = function(event)
    {
        disableButton();
    }

    document.querySelector('#categoria_id').onchange = function(event)
    {
        window.location.href = '<?= route_to('etiqueta.etiquetas',$etiqueta->id,)?>?categoria_id='+this.value;
    }
    disableButton();

</script>