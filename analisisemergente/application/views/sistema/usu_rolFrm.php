
<form id="usu_rolFrm">
    <table class="formDialog">
        <tr>
            <th>
                Aplicación
            </th>
            <td>
                <input type="text" id="USR_SISTEMA" size="50" name="USR_SISTEMA" value="<?php echo !empty($USR_SISTEMA)? $USR_SISTEMA : null ; ?>" maxlength="125" readonly="readonly"/>
            </td>
        </tr>
        <tr>
            <th>
                Descripción
            </th>
            <td>
                <input type="text" id="USR_DESCRIPCION" size="50" name="USR_DESCRIPCION" value="<?php echo !empty($USR_DESCRIPCION)? $USR_DESCRIPCION : null ; ?>" maxlength="125" />
            </td>
        </tr>

    </table>

    <input type="hidden" value="<?php echo !empty($USR_SECUENCIAL)? $USR_SECUENCIAL : null ; ?>" name="USR_SECUENCIAL" />

</form>

<script type="text/javascript">
$(document).ready(function(){ 
    $("table.formDialog tr th,table.formDialog caption").addClass("ui-widget ui-widget-header");
    $("table.formDialog tr td").addClass("ui-widget ui-widget-content");
    $("table.formDialog tr td.noClass").removeClass("ui-widget ui-widget-content");

    /*
    * Estilo para todos los elementos "solo lectura"
    **/

    $('input[readonly="readonly"]').addClass("readonly");
    $('input[readonly!="readonly"]').removeClass("readonly");



    $(".radio").buttonset();
    
    $(".grabar").button({
                icons: {
                    primary: "ui-icon-disk"
                }
            });

}); 
</script>


