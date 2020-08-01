<?php
/*
 * dialog_confirmacion
 */
$hidden = array($field => !empty($_POST[$field])?$_POST[$field]:null,'ADM'=>$_POST['ADM']);
echo form_open('#', array("id"=>!empty($frmId)?$frmId:"frmListas"), $hidden);
echo alerta($mensaje); ?>
<?php echo form_close(); ?>