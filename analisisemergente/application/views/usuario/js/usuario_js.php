<style>
  .ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 100px;
  }
  </style>
<script type="text/javascript">

jQuery(document).ready(function(){
    $("table.formDialog tr th,table.formDialog caption").addClass("ui-widget ui-widget-header");
    $("table.formDialog tr td").addClass("ui-widget ui-widget-content");
    $("table.formDialog tr td.noClass").removeClass("ui-widget ui-widget-content");
    
   var accion='<?php echo $accion;?>';
   var numero='<?php echo !empty($sol->US_SECUENCIAL) ? prepCampoMostrar($sol->US_SECUENCIAL) : null ; ?>';
   
   //Acciones que se manejan en base a los eventos
   if (accion=='n'){ //nueva
        $('#cabecera :input').attr('disabled', false);
        $('#co_grabar').attr('disabled',false);
    } else {
        if (accion=='e'){ //edicion
            $('#co_grabar').attr('disabled',false);            
        }else{ //ver
          $('#cabecera :input').attr('disabled', true);  
        }
    }
    
	//Botón para guardar
    $("#co_grabar").button({
        icons:{
            primary: "ui-icon-disk"
        }
    });
			
	//Funcion para validar correo		
	function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) ){
		$('#US_MAIL').val('');
        alert("!!!...Error: La dirección de correo: " + email + ", es incorrecta...!!!");
	}
		}
			
		
	$("#US_MAIL").change(function() {
        validarEmail($('#US_MAIL').val());        
    })
	
	//Funcion para combo de Pais en carga		 
	$('#LOC_PAIS').change(function() {
                    $("#LOC_PROVINCIA").val("");
                    $("#LOC_CIUDAD").val("");
					datos_provincia($('#LOC_PAIS').val());
            });
			
	//Funcion para combo de Provincia en carga		
	$('#LOC_PROVINCIA').change(function() {
				$("#LOC_CIUDAD").val("");
			    datos_ciudad($('#LOC_PROVINCIA').val());
            });			
			
	//Funcion para combo de Provincia en carga		
	$('#LOC_CIUDAD').change(function() {
				$("#LOC_SECTOR").val("");
			    datos_sector($('#LOC_CIUDAD').val());
            });		
	
	//Funcion para tomar datos de provincia a partir del pais
	function datos_provincia(pais){
        $.post("varios/get_provincia",{pais:pais},
            function(data){
               $("#LOC_PROVINCIA").empty().html(data);
         },"html");                 
    }
	
	//Funcion para tomar datos de ciudad a partir de provincia
	function datos_ciudad(ciudad){
        $.post("varios/get_ciudad",{ciudad:ciudad},
            function(data){
               $("#LOC_CIUDAD").empty().html(data);
         },"html");                 
    }
	
	//Funcion para tomar datos de sector a partir de ciudad
	function datos_sector(sector){
        $.post("varios/get_sector",{sector:sector},
            function(data){
               $("#LOC_SECTOR").empty().html(data);
         },"html");                 
    }

//Maneojo de los campos tanto para un nuevo como para editar	
$("#fusuario").validate({
       errorClass: "ui-state-error",
       validClass: "ui-state-highlight",
       wrapper: "span class='ui-extra-validation ui-widget ui-container'",

       submitHandler: function(form){
           $.ajax({
               type: "POST",
               url:  "usuario/admUsuario/"+accion,
               data: $("#fusuario").serialize(),
               dataType:"json",
               success: function(r){
                       if (r.cod>0) {
                           $("#fusuario").jConfirmacion({
                                        titulo:"Usuario: "+r.numero,
                                        mensaje: r.mensaje,
                                        tipoMensaje:"highlight",
                                        ancho: 250,
                                        posicion: "center"
                            });
                           $(":input","#cabecera").attr("disabled", true);
                           if (accion=='n'){
                                $("#US_SECUENCIAL").val(r.numero);
								}
                                $("#co_grabar").hide();
                       } else {
                           alert("Error no se ha grabado la información");
                       }
               }
           })// ajax
       },  //submit handler
       rules:{
			"US_CODIGO":{required:true},
			"US_NOMBRES":{required:true},
			"US_MAIL":{required:true}
             }
     });     
});
</script>