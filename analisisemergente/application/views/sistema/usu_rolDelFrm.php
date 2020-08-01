<form id="usu_rolFrm">
    <?php echo highlight("¿Esta seguro que desea eliminar el perfil?"); ?>
    <input type="hidden" value="<?php echo !empty($USR_SECUENCIAL)?$USR_SECUENCIAL:null;?>" name="USR_SECUENCIAL" />
</form>