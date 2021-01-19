<?php if(session('exito') != null):?>
    <div class="alertExito">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?php echo session('exito') ?>
    </div>
<?php endif; ?>

<?php if(session('error') != null):?>
    <div class="alertError">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?php echo session('error') ?>
    </div>
<?php endif; ?>
