<?php
$hidden = array('LOC_SECUENCIAL' => !empty($_POST['LOC_SECUENCIAL'])?$_POST['LOC_SECUENCIAL']:0,'ADM' => $_POST['ADM']);
echo form_open('#', array("id" => "frmLugar"), $hidden);
echo highlight("Por favor, ingresa el nombre y descripción del item");
$this->table->set_template(array ('table_open' => '<table class="formDialog" cellpadding="2" cellspacing="1">'));
	//Campo Descripción
	$this->table->add_row(array('data' => 'Descripción', 'class' => 'field'),
    form_input('LOC_DESCRIPCION', !empty($LOC_DESCRIPCION)?($LOC_DESCRIPCION):null,'id="LOC_DESCRIPCION"'));
	//Campo Codigo de area
	$this->table->add_row(array('data' => 'Código De Área', 'class' => 'field'),
    form_input('LOC_CODIGO_AREA', !empty($LOC_CODIGO_AREA)?($LOC_CODIGO_AREA):null,'id="LOC_CODIGO_AREA"'));
	
$data = array(
    'name' => 'LOC_PREDECESOR',
    'id' => 'LOC_PREDECESOR',
    'type' => 'hidden',
    'value' => !empty($_POST['LOC_PREDECESOR'])?$_POST['LOC_PREDECESOR']:0
    );
echo $this->table->generate();
echo form_input($data);
?>
<table  id="jq_lugarItemsExtend" class="scroll" cellpadding="0" cellspacing="0">
</table>
<div id="jq_p_lugarItemsExtend" class="scroll" style="text-align:center;"></div>
<div id="mensaje">
</div>
<?php
echo form_close();
?>