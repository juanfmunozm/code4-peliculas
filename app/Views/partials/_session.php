
<?php if(session('mensaje')) : ?>

<div class="alert alert-success my-4 alert-dismissible fade show" role="alert">
        <?= session('mensaje') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

        
<?php endif ?>