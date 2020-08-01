<?php
    echo highlight("Por favor, ingresa los datos; una vez terminado presiona el botón grabar para continuar.");
?>
<form id="usu_dirFrm">
    <table class="formDialog">
        <tr>
            <th>
               SISTEMA
            </th>
            <td>
                <input type="text" value="<?php echo !empty($USR_SISTEMA)?$USR_SISTEMA:null;?>" name="USR_SISTEMA" readonly="readonly"/>
            </td>
        </tr>
        <tr>
            <th>
                DIRECTIVA(*)
            </th>
            <td>
                <?php echo !empty($COMBO_DIRECTIVAS)? $COMBO_DIRECTIVAS : null ; ?>
            </td>
        </tr>
        <tr>
            <th>
                ELEMENTOS
            </th>
            <td id="contenedorElementos">
                
            </td>
        </tr>
    </table>
    <input type="hidden" value="<?php echo !empty($USR_SECUENCIAL)?$USR_SECUENCIAL:null;?>" name="USP_SECPERFIL" />
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


    $('label').each(function() {
        $(this).addClass('title');
    });
    $('.radio label').each(function() {
        $(this).removeClass('title');
    });

    $(".radio").buttonset();
    
    $(".grabar").button({
                icons: {
                    primary: "ui-icon-disk"
                }
            });
    
    $("#USP_SECDIRECTIVA").change(function(){
        $.post("sistema/getDirectivaRow", { "USD_SECUENCIAL": $(this).val() },
        function(data){
            $("#contenedorElementos").html(data);
        }, "html");
    })
    
}); 
</script>

