<form id="frmappDirectiva">
<div id="cabecera">
<input type="hidden" name="USD_SECUENCIAL" id="USD_SECUENCIAL" size="20" class="required may"  value="<?php echo empty($USD_SECUENCIAL)?null:$USD_SECUENCIAL; ?>" readonly="readonly"/>
<table class="formDialog">
    <tr>
    <th>
           Sistema
    </th>  
    <td>
        <input type="text" name="USD_SISTEMA" id="USD_SISTEMA" size="20" class="required may"  value="<?php echo empty($USD_SISTEMA)?null:$USD_SISTEMA; ?>" readonly="readonly"/>
    </td>
    </tr>
    <tr>
    <th>
         Directiva(*)
    </th>  
    <td>
        <input type="text" name="USD_DESCRIPCION" id="USD_DESCRIPCION" size="50" class="required"  value="<?php echo empty($USD_DESCRIPCION)?null:$USD_DESCRIPCION; ?>"/>
    </td>
    </tr>
    <tr>
    <th>
          Alias(*)
    </th>  
    <td>
       <input type="text" name="USD_ALIAS" id="USD_ALIAS" size="20"  class="required may" value="<?php echo empty($USD_ALIAS)?null:$USD_ALIAS; ?>"/>
    </td>

    </tr>
</table>
</div>
</form>     
<script type="text/javascript">
jQuery(document).ready(function(){
    
$("table.formDialog tr th,table.formDialog tr td.field,table.formDialog caption").addClass("ui-widget ui-widget-header");
    $("table.formDialog tr td").addClass("ui-widget ui-widget-content");
    $("table.formDialog tr td.noClass").removeClass("ui-widget ui-widget-content");
    $('input[readonly="readonly"]').addClass("readonly");
    $('input[readonly!="readonly"]').removeClass("readonly");

    var accion='<?php echo $accion;?>';

    $('.may').capitalize();

});
</script>