<style type="text/css">
    body { font-size: 70%; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
</style>


<div id="d_cambiar_contrasena" class="demo" title="Parámetros">

    <div id="dialogo-password" class="dialogo_password_unico" title="Cambiar Clave">
	<p class="validateTips">Todos los campos son requeridos</p>

	<form>
	<fieldset>
		<label for="password">Clave Anterior</label>
		<input type="password" name="password1" id="password1" value="" class="text ui-widget-content ui-corner-all" />
                <label for="password">Clave Nuevo</label>
		<input type="password" name="password2" id="password2" value="" class="text ui-widget-content ui-corner-all" />
                <label for="password">Clave Nuevo</label>
		<input type="password" name="password3" id="password3" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
    
<div id="users-contain" class="ui-widget">
<br>
<br>
<h3>Bienvenido a Gestión de Documentos</h3>

<?=form_open('ingreso/salida')?>
<h4><?php echo $this->session->userdata('NOMBRE'); ?> </h4>
<br></br>
<p><?php echo $this->session->userdata('LOCALIDAD'); ?> </p>
<br></br>
<p><?php echo $this->session->userdata('PROYECTOS'); ?> </p>
    <div class="buttons">
	<!--    
      <input type="submit" id="logout" value="Salir" />
	    -->
	    <button id="cambiar" type="button">Cambio de  Clave</button>
    </div>
<?=form_close();?>
</div>

</div>
<script>
	$(function() {
	  FACTURACION.crearWijdialog("#d_cambiar_contrasena", 
	  { position: [45, 75], width: 800});
	  
            $("#dialogo-password").dialog( "destroy" );
	    if($(".dialogo_password_unico").size() > 1){
	      $(".dialogo_password_unico:eq(0)").remove();
	    }
              var  password1 = $( "#password1" ),
                     password2 = $( "#password2" ),
                     password3 = $( "#password3" ),
		     allFields = $( [] ).add( password1 ).add( password2 ).add( password3 ),
		     tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "La longuitud " + n + " debe tener entre " +
					min + " y " + max + " caracteres" );
				return false;
			} else {
				return true;
			}
		}

                function camposiguales( p1, p2 ) {
			if ( p1.val()== p2.val() ) {
				return true;
			} else {
                                p1.addClass( "ui-state-error" );
                                p2.addClass( "ui-state-error" );
				updateTips( "La confirmación del password nuevo no coincide" );
				return false;

			}
		}

                function verificarclaveanterior (p1){
                    var flag="0";
                    $.ajax({
                        async : false,
                        data: {clave: p1.val() },
                        url:"<?php echo site_url('ingreso/verificaclave')?>/",
                        type:"POST",
                        dataType:"text",
                        success:function(r){
                            flag=r;
                        }
                    });
                    if (flag=='0') {
                       p1.addClass( "ui-state-error" );
                       updateTips( "Password actual incorrecto" );
                       return false;
                    } else {
                       return true;}
                }

                function grabarclave(p2){
                    var flag="0";
                    $.ajax({
                        async : false,
                        data: {clave: p2.val()},
                        url:"<?php echo site_url('ingreso/grabarclave')?>/",
                        type:"POST",
                        dataType:"text",
                        success:function(r){
                            flag=r;
                        }
                    });
                    if (flag=='0') {
                       updateTips( "No se ha grabado la clave nueva" );
                       return false;
                    } else {
                       return true;}
                }

            $( "#dialogo-password" ).dialog({
			autoOpen: false,
			height: 320,
			width: 340,
			modal: true,
                        buttons:{
                        "Cambiar Password":function(){
                                        var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && checkLength( password2, "Password Nuevo", 4, 8 );
					bValid = bValid && camposiguales( password2, password3 );
                                        bValid = bValid && verificarclaveanterior( password1 );

                                        if ( bValid ) {
						bValid = grabarclave(password2);
                                                if ( bValid ) {
						   $( this ).dialog( "close" );
                                                } else {
                                                    alert("No se ha cambiado la clave");
                                                }
					}

                            },
                            "Cancelar":function(){
                                $( this ).dialog( "close" );
                            }
                        },// buttons
                        close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
	      });


            
            $( "#logout" )
			.button();
            $( "#cambiar" )
			.button()
			.click(function() {
				$( "#dialogo-password" ).dialog( "open" );
			});

        });//

</script>