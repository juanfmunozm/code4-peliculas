
<?php if(session('errorValidation')) : ?> 
        <div class="alert alert-danger">
                <?= session('errorValidation');?>
        </div>
<?php endif ?>