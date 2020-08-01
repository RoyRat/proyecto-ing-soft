<div id="accordion" class="cuadroUserApp">
	<form id="frmUserapp">
<div id="cabecera">
    <input type="hidden" name="ACC_SECUENCIAL" id="ACC_SECUENCIAL" size="20" class="required may"  value="<?php echo empty($ACC_SECUENCIAL)?null:$ACC_SECUENCIAL; ?>" readonly="readonly"/>
<table class="formDialog">
    <tr>
	<th>
		Codigo
    </th>  
    <td>
        <input type="text" name="ACC_SEC_USUARIO" id="ACC_SEC_USUARIO" style="width:200px;" size="20" class="required may"  value="<?php echo empty($ACC_SEC_USUARIO)?null:($ACC_SEC_USUARIO); ?>" readonly="readonly"/>
    </td>
	
    <th>
           Nombres
    </th>  
    <td>
        <input type="text" name="US_NOMBRES" id="US_NOMBRES" size="20" style="width:200px;" class="required may"  value="<?php echo empty($US_NOMBRES)?null:($US_NOMBRES); ?>" readonly="readonly"/>
    </td>
    </tr>
    <tr>
    <th>
          Aplicación
    </th>  
    <td>
        <?php echo $cmbapp; ?> 
    </td>
	
	<th>
          Perfil
    </th>  
    <td>
        <?php echo $cmbperfil; ?> 
    </td>
    </tr>
</table>
</div>
</form> 
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
    
$("table.formDialog tr th,table.formDialog tr td.field,table.formDialog caption").addClass("ui-widget ui-widget-header");
    $("table.formDialog tr td").addClass("ui-widget ui-widget-content");
    $("table.formDialog tr td.noClass").removeClass("ui-widget ui-widget-content");
    $('input[readonly="readonly"]').addClass("readonly");
    $('input[readonly!="readonly"]').removeClass("readonly");

    var accion='<?php echo $accion;?>';         

    if (accion=='e'){
        $("#ACC_SEC_APLICACION").attr("disabled", true);        
    }
    
    $('.may').capitalize();
    
       $("#ACC_SEC_APLICACION").change(function() {
        $.post("usuario/get_roles",
            {aplicacion:$('#ACC_SEC_APLICACION').val()},
            function(data){
               $("#ACC_SEC_ROLES").empty().html(data);
         },"html");
    })

});
</script>
