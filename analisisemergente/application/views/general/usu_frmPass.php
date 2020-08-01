<script type="text/javascript">
$(document).ready(function(){ 
    $("table.formDialog tr th,table.formDialog caption").addClass("ui-widget ui-widget-header");
    $("table.formDialog tr td").addClass("ui-widget ui-widget-content");
    $("table.formDialog tr td.noClass").removeClass("ui-widget ui-widget-content");
    
    if(<?php echo $cambiopassword;?>>0) {
            if(<?php echo $cambiopassword;?>==1) {
                alert("Su password debe ser cambiado");
            }
            if(<?php echo $cambiopassword;?>==2) {
                alert("Su password ha caducado");
            }


    }
    $("#frmPass").jValidacion({
                submitAccion: function(){
                    var data = $("#frmPass").serialize();
                    $.post("usuarios/GrbFrmPrtPass", data,
                     function(data){
                            var NombreDialog = "dialog_"+$().jRand(10,100);
                            $("#contenido_general").append("<div id='"+NombreDialog+"' title='Procesando...'></div>");
                            $("#"+NombreDialog).html(data.mensaje).dialog({
                            buttons: {
                                "Cerrar": function(){
                                    $(this).dialog("destroy");
                                    $("#"+NombreDialog).remove();
                                    $("#frmPass").remove();
                                  //   $("#e_proyecto span").trigger("click");
                                    }
                                }
                            });
                        },
                        "json");
                },
                rules:{
                    pass: {
                        //password: "#US_CODIGO"
                        required:true
                    },
                    pass_conf: {
                        required: true,
                        equalTo: "#pass"
                    }
                }
            });

            $("#bgrabarpass").button({
                text: true,
                icons: {
                    primary: "ui-icon-disk"
                }
        });

            
    }); 
</script>
<style type="text/css">
    table.formDialog{
        color:#006600;
        margin: 5px 5px;
    }
    
    table.formDialog label{
        color: #666;
        font-weight: bold;
        font-size: 0.7em;
    }
    
    button#co_grabar_boton{
        margin: 10px 3px 5px 3px;
        font-size: 1.3em;
        font-weight: bold;
    }
    
   table.formDialog{
        margin-left:2%; 
        margin-right:2%;
        width: 96%;
    }
    
   table.formDialog tr td,table.formDialog tr th{
        padding: 4px;
        text-align: center;
        vertical-align: middle;
    }
    
    table.formDialog tr td{
        font-size: 1.1em !important;
    }
    
    
   table.formDialog caption{
        font-size: 1.2em !important;
    }
    
    span.ui-extra-validation{
        margin: 2px !important;
    }
    span.small{
        font-size:0.2em;
    }

    .password-meter {
	position:relative;
	width: 180px;
}
.password-meter-message {
	text-align: right;
	font-weight: bold;
	color: #676767;
}
.password-meter-bg, .password-meter-bar {
	height: 4px;
}
.password-meter-bg {
	top: 8px;
	background: #e0e0e0;
}

.password-meter-message-very-weak {
	color: #aa0033;
}
.password-meter-message-weak {
	color: #f5ac00;
}
.password-meter-message-good {
	color: #6699cc;
}
.password-meter-message-strong {
	color: #008000;
}

.password-meter-bg .password-meter-very-weak {
	background: #aa0033;
	width: 30px;
}
.password-meter-bg .password-meter-weak {
	background: #f5ac00;
	width: 60px;
}
.password-meter-bg .password-meter-good {
	background: #6699cc;
	width: 135px;
}
.password-meter-bg .password-meter-strong {
	background: #008000;
	width: 180px;
}
    
</style>
<form id="frmPass">
        <div id="d_user"> </div>
	<input type="hidden" name="US_CODIGO" id="US_CODIGO" value="<?php echo $US_CODIGO;?>" />
	<table class="formDialog">
		<tr>
			<td colspan="4">
                            <?php if ($cambiopassword==0): ?>
				  <?php echo highlight("Ingresa la contraseña para el usuario <b>".$US_CODIGO."</b>");?>
                               <?php endif; ?>
                            <?php if ($cambiopassword==1): ?>
				  <?php echo highlight("Cambio de contraseña requerido para <b>".$US_CODIGO."</b>");?>
                               <?php endif; ?>
                            <?php if ($cambiopassword==2): ?>
				  <?php echo highlight("Clave caducada para el usuario <b>".$US_CODIGO."</b>");?>
                               <?php endif; ?>
			</td>
		</tr>
		<tr>
			<th>
				Contraseña
			</th>
			<td>
				<input name="pass" id="pass"  TYPE="password"/>
<!--				<div class="password-meter">
				<div class="password-meter-message">&nbsp;</div>
				<div class="password-meter-bg">
				<div class="password-meter-bar"></div>-->
				</div>
				</div>
			</td>
			<th>
				Confirmación
			</th>
			<td>
				<input name="pass_conf" TYPE="password"/>
				<br /><br />
			</td>
		</tr>
                <tr>
                   <td colspan="4">
                       <input type="submit" id="bgrabarpass" value="Grabar" />
                   </td>
                </tr>
	</table>
       
</form>