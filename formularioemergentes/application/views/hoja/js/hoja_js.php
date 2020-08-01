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
   
   $('#FORM_PAIS_NACIMIENTO').hide();
   $('#FORM_PROVINCIA_NACIMIENTO').hide();
   $('#FORM_CANTON_NACIMIENTO').hide();
   
   $('#FORM_PAIS_RESIDE').hide();
   $('#FORM_PROVINCIA_RESIDE').hide();
   $('#FORM_CANTON_RESIDE').hide();
   
   $('#FORM_PAIS_SUFRAGIO').hide();
   $('#FORM_PROVINCIA_SUFRAGIO').hide();
   $('#FORM_CANTON_SUFRAGIO').hide();
   $('#FORM_SECTOR_SUFRAGIO').hide();
            
   $('#PORDISCAPACIDAD').hide();
   $('#CARNETIPO').hide();
   $('#DISCAPASIDADDES').hide();
   
   $('#OBSEMFERMEDAD').hide();
   $('#OBSALERGIA').hide();
   $('#OBSMEDICACION').hide();
   $('#HORARIOLABORA').hide();
      
   $('#USOINGRESOS').hide();
   $('#INGRESOSDES').hide();
   
   $('#TIPOREDES').hide();
   $('#FORM_LUGAR_ROBODES').hide();
      
   //Acciones que se manejan en base a los eventos
   if (accion=='n'){ //nueva
        $('').attr('disabled', false);
        $('#co_grabar').attr('disabled',false);
    } else {
        if (accion=='e'){ //edicion
            $('#co_grabar').attr('disabled',false);            
        }else{ //ver
          $('').attr('disabled', true);  
        }
    }
	    
	//Botón para guardar
    $("#co_grabar").button({
        icons:{
            primary: ""
        }
    });
	
		
	//Funcion para validar correo
	function validarEmailNormal( email,campo ) {
		expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if ( !expr.test(email) ){
			var campoValida="#"+campo;
			$(campoValida).val('');
			alert("!!!...Error: La dirección de correo: " + email + ", es Incorrecta...!!!");
		}
	}
	
	
	//Valida Cedula Ecuatoriana
	function validarCedula( cedula,campo ){
		var campoValida="#"+campo;
		var cad = cedula.trim();
		var total = 0;
		var longitud = cad.length;
		var longcheck = longitud - 1;
		
		if (cad !== "" && longitud === 10){
			for(i = 0; i < longcheck; i++){
				if (i%2 === 0) {
					var aux = cad.charAt(i) * 2;
					if (aux > 9) aux -= 9;
					total += aux;
					} else {
					total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
				}
			}
			
			total = total % 10 ? 10 - total % 10 : 0;
			
			if (cad.charAt(longitud-1) == total) {
				$(campoValida).val(cedula);
				}else{
				alert("Cedula Inválida");
				$(campoValida).val('');
			}
			}else{
			alert("Cedula Inválida");
			$(campoValida).val('');
		}
	}
	
	//cedula personal
	$("#FORM_CEDULA").change(function() {
			if(1==$('#FORM_TIPODOCUMENTO').val()){
				validarCedula($('#FORM_CEDULA').val(),"FORM_CEDULA");
			}
		});
				
	//encera los campos al hacer una accion		
	$("#FORM_TIPODOCUMENTO").change(function() {
				$('#FORM_CEDULA').val("");
				$('#FORM_NOMBRES').val("");
		});	
		
	$("#FORM_DISCAPACIDAD").change(function() {
				$('#FORM_PORDISCAPACIDAD').val("");
				$('#FORM_CARNETCONADIS').val("");
				$('#FORM_TIPODISCAPACIDAD').val(null);
		});	
	
				
	//correo contacto	
	$("#FORM_CORREO_PERSONAL").change(function() {
			validarEmailNormal($('#FORM_CORREO_PERSONAL').val(),"FORM_CORREO_PERSONAL");        
		});
	
	//correo contacto	
	$("#FORM_CORREO_CONTACTO").change(function() {
			validarEmailNormal($('#FORM_CORREO_CONTACTO').val(),"FORM_CORREO_CONTACTO");        
		});
		
	//REQUERIDOS
	$('#FORM_POSEE_DISCAPACIDAD').change(function() {
		var discapacidad=$('#FORM_POSEE_DISCAPACIDAD').val();
				if(discapacidad==1 && discapacidad!=''){
					$('#PORDISCAPACIDAD').show();
					$('#CARNETIPO').show();
					$('#FORM_PORDISCAPACIDAD').attr('required',true);
					$('#FORM_CARNETCONADIS').attr('required',true);
					$('#FORM_TIPODISCAPACIDAD').attr('required',true);
				}else{
					$('#PORDISCAPACIDAD').hide();
					$('#CARNETIPO').hide();
					$('#FORM_PORDISCAPACIDAD').val('0');
					$('#FORM_CARNETCONADIS').val('0');
					$('#FORM_TIPODISCAPACIDAD').val('0');
					$('#FORM_PORDISCAPACIDAD').attr('required',false);
					$('#FORM_CARNETCONADIS').attr('required',false);
					$('#FORM_TIPODISCAPACIDAD').attr('required',false);
				}
		}); 
	
		
	$('#FORM_POSEE_ENFERMEDAD').change(function() {
		var emfermedad=$('#FORM_POSEE_ENFERMEDAD').val();
				if(emfermedad==1 && ''!=emfermedad){
					$('#OBSEMFERMEDAD').show();
					$('#FORM_EMFERMEDADDES').attr('required',true);
				}else{
					$('#OBSEMFERMEDAD').hide();
					$('#FORM_EMFERMEDADDES').val('NA');
					$('#FORM_EMFERMEDADDES').attr('required',false);
				}
		});	
	
	$('#FORM_POSEE_ALERGIA').change(function() {
		var alergia=$('#FORM_POSEE_ALERGIA').val();
				if(alergia==1 && ''!=alergia){
					$('#OBSALERGIA').show();
					$('#FORM_ALERGIADES').attr('required',true);
				}else{
					$('#OBSALERGIA').hide();
					$('#FORM_ALERGIADES').val('NA');
					$('#FORM_ALERGIADES').attr('required',false);
				}
		});
			
	$('#FORM_POSEE_MEDICACION').change(function() {
		var medicacion=$('#FORM_POSEE_MEDICACION').val();
				if(medicacion==1 && ''!=medicacion){
					$('#OBSMEDICACION').show();
					$('#FORM_MEDICACIONDES').attr('required',true);
				}else{
					$('#OBSMEDICACION').hide();
					$('#FORM_MEDICACIONDES').val('NA');
					$('#FORM_MEDICACIONDES').attr('required',false);
				}
		});

			
	$('#FORM_LABORA').change(function() {
		var labora=$('#FORM_LABORA').val();
				if(labora==1 && ''!=labora){
					$('#HORARIOLABORA').show();
					$('#USOINGRESOS').show();
					$('#FORM_HORARIO_LABORA').attr('required',true);
					$('#FORM_USA_INGRESOS').attr('required',true);
				}else{
					$('#HORARIOLABORA').hide();
					$('#USOINGRESOS').hide();
					$('#FORM_HORARIO_LABORA').val('NA');
					$('#FORM_USA_INGRESOS').val('NA');
					$('#FORM_HORARIO_LABORA').attr('required',false);
					$('#FORM_USA_INGRESOS').attr('required',false);
				}
		});

	$('#FORM_USA_INGRESOS').change(function(){
		var usoingreso=$('#FORM_USA_INGRESOS').val();
				if(usoingreso==5 && ''!=usoingreso){
					$('#INGRESOSDES').show();
					$('#FORM_INGRESOSDES').attr('required',true);
				}else{
					$('#INGRESOSDES').hide();
					$('#FORM_INGRESOSDES').attr('required',false);
				}
		});
		
	$('#FORM_LUGAR_ROBOS').change(function() {
		var lugarRobos=$('#FORM_LUGAR_ROBOS').val();
				if(lugarRobos==7 && ''!=lugarRobos){
					$('#FORM_LUGAR_ROBODES').show();
					$('#FORM_LUGAR_ROBODES').attr('required',true);
				}else{
					$('#FORM_LUGAR_ROBODES').hide();
					$('#FORM_LUGAR_ROBODES').val(null);
					$('#FORM_LUGAR_ROBODES').attr('required',false);
				}
		});
		
	$('#FORM_REDSOCIAL').change(function() {
		var redsocial=$('#FORM_REDSOCIAL').val();
				if(redsocial==1 && ''!=redsocial){
					$('#TIPOREDES').show();
					$('#FORM_TIPOREDSOCIAL').attr('required',true);
				}else{
					$('#TIPOREDES').hide();
					$('#FORM_TIPOREDSOCIAL').val('0');
					$("#myCheck").prop("checked", false);
					$("#myCheck1").prop("checked", false);
					$("#myCheck2").prop("checked", false);
					$("#myCheck3").prop("checked", false);
					$("#myCheck4").prop("checked", false);
					$('#FORM_TIPOREDSOCIAL').attr('required',false);
				}
		});		
		
			
//Manejo de los campos tanto para un nuevo como para editar	
$("#fhoja").validate({
       errorClass: "ui-state-error",
       validClass: "ui-state-highlight",
       wrapper: "span class='ui-extra-validation ui-widget ui-container'",		
       submitHandler: function(form){
           $.ajax({
               type: "POST",
               url:  "index.php/hoja/nuevoForm",
               data: $("#fhoja").serialize(),
               dataType:"json",
               success: function(r){
                       if (r.cod>0) {
                           $("#fhoja").jConfirmacion({
                                        titulo:"Formulario: "+r.numero,
                                        mensaje: r.mensaje,
                                        tipoMensaje:"highlight",
                                        ancho: 500,
                                        posicion: "center"
                            });
                           $(":input","#cabecera").attr("disabled", true);
                           if (accion=='n'){
                                $("#FORM_SECUENCIAL").val(r.numero);
								}
								$(":input","#cabecera").attr("disabled", false);
								$('input').val('');
								$('selected').val(null);
								$('#FORM_NUMHIJOS').val(0);
								$('#FORM_NUMFAMILIA').val(0);
								$('#FORM_INGRESOSFAMILIA').val(0);
								$('#FORM_TIPODOCUMENTO').val(null);
								$('#FORM_GENERO').val(null);
								$('#FORM_CIVIL').val(null);
								$('#FORM_SANGRE').val(null);
								$('#FORM_ETNIA').val(null);
								$('#FORM_DISCAPACIDAD').val(null);
								$('#FORM_POSEE_ENFERMEDAD').val(null);
								$('#FORM_POSEE_ALERGIA').val(null);
								$('#FORM_POSEE_MEDICACION').val(null);
								$('#FORM_TIPODISCAPACIDAD').val(null);
								$('#FORM_LABORA').val(null);
								$('#FORM_CERTIDIOMA').val(null);
								$('#FORM_USOINGRESO').val(null);
								$('#FORM_PARIENTEBONO').val(null);
								$('#FORM_RELACIONCONTACTO').val(null);
								$('#LOC_PAISNAC').val(null);
								$('#LOC_PAISRESIDE').val(null);
								$('#LOC_PROVINCIANAC').val(null);
								$('#LOC_PROVINCIARESIDE').val(null);
								$('#LOC_CIUDADNAC').val(null);
								$('#LOC_CIUDADRESIDE').val(null);
								$('#FORM_REDSOCIAL').val(null);
								$('#FORM_TIPOREDSOCIAL').val(null);
								location.reload();
                       } else {
                           alert("Error no se ha grabado la información");
                       }
               }
           })// ajax
       },  //submit handler
       rules:{
			"documento":{required:true},
			"FORM_CORREO_PERSONAL":{required:true},
			"FORM_CEDULA":{required:true},
			"FORM_APELLIDOS":{required:true},
			"FORM_NOMBRES":{required:true},
			"FORM_FECHA_NACIMIENTO":{required:true},
			"FORM_CELULAR":{required:true},
			"paisnacionalidad":{required:true},
			"paisreside":{required:true},
			"paissufragio":{required:true},
			"FORM_DIRECCION":{required:true},
			"genero":{required:true},
			"civil":{required:true},
			"etnia":{required:true},
			"tipoSangre":{required:true},
			"FORM_NUM_COMPUS":{required:true},
			"FORM_NUM_CELULARES":{required:true},
			"FORM_NUM_TABLETS":{required:true},
			"internet":{required:true},
			"FORM_NUM_ESTUD_EAC":{required:true},
			"FORM_NUM_ESTUD_UNIV":{required:true},
			"FORM_NUM_ESCCOL":{required:true},
			"FORM_NUM_UNIVERSIDADES":{required:true},
			"cargodiscapacidad":{required:true},
			"discapacidad":{required:true},
			"enfermedad":{required:true},
			"alergia":{required:true},
			"medicacion":{required:true},
			"cercamsp":{required:true},
			"FORM_NUM_FARMACIAS":{required:true},
			"FORM_NUM_HOSPITALES":{required:true},
			"jornada":{required:true},
			"trabajo":{required:true},
			"formacion":{required:true},
			"bono":{required:true},
			"vivienda":{required:true},
			"cercareten":{required:true},
			"FORM_NUM_PATRULLAJES":{required:true},
			"alarma":{required:true},
			"FORM_NUM_ROBOS":{required:true},
			"frecuencia":{required:true},
			"lugarrobos":{required:true},
			"FORM_NOMBRES_CONTACTO":{required:true},
			"FORM_CELULAR_CONTACTO":{required:true},
			"FORM_INGRESOSFAMILIA":{required:true},
			"FORM_NUMFAMILIA":{required:true},
			"FORM_LUGARSUFRAGIO":{required:true},
			"FORM_NUMHIJOS":{required:true},
			"idioma":{required:true},
			"redsocial":{required:true},			
			"relcontacto":{required:true},
			"pueblos":{required:true}
             }
     });
	 
	 //NACIONALIDAD
	 //Funcion para combo de Pais en carga		 
		$('#LOC_PAISNAC').change(function() {
			var pais=$('#LOC_PAISNAC').val();
				if(pais=='OT'){
					$("#FORM_PAIS_NACIMIENTO").val("");
					$("#FORM_PROVINCIA_NACIMIENTO").val("");
					$("#FORM_CANTON_NACIMIENTO").val("");
					
					$('#FORM_PAIS_NACIMIENTO').show();
					$('#FORM_PAIS_NACIMIENTO').attr('required',true);
					$('#FORM_PROVINCIA_NACIMIENTO').show();
					$('#LOC_PROVINCIANAC').hide();
					$('#FORM_PROVINCIA_NACIMIENTO').attr('required',true);
					$('#FORM_CANTON_NACIMIENTO').show();
					$('#LOC_CIUDADNAC').hide();
					$('#FORM_CANTON_NACIMIENTO').attr('required',true);
					$("#LOC_PROVINCIANAC").val("");
					$("#LOC_CIUDADNAC").val("");
				}else{
					$('#LOC_PROVINCIANAC').show();
					$('#LOC_PROVINCIANAC').attr('required',true);
					$('#LOC_CIUDADNAC').show();
					$('#LOC_CIUDADNAC').attr('required',true);
					
					$('#FORM_PAIS_NACIMIENTO').hide();
					$('#FORM_PAIS_NACIMIENTO').attr('required',false);
					$('#FORM_PROVINCIA_NACIMIENTO').hide();
					$('#FORM_PROVINCIA_NACIMIENTO').attr('required',false);
					$('#FORM_CANTON_NACIMIENTO').hide();
					$('#FORM_CANTON_NACIMIENTO').attr('required',false);
					
					$("#FORM_PAIS_NACIMIENTO").val("");
					$("#FORM_PROVINCIA_NACIMIENTO").val("");
					$("#FORM_CANTON_NACIMIENTO").val("");
					
					$("#LOC_PROVINCIANAC").val("");
					$("#LOC_CIUDADNAC").val("");
					datos_provincia($('#LOC_PAISNAC').val());
				}			
		});
		
		//Funcion para combo de Provincia en carga		
		$('#LOC_PROVINCIANAC').change(function() {
			$("#LOC_CIUDADNAC").val("");
			datos_ciudad($('#LOC_PROVINCIANAC').val());
		});
				
		//Funcion para tomar datos de provincia a partir del pais
		function datos_provincia(pais){
			$.post("varios/get_provincia",{pais:pais},
            function(data){
				$("#LOC_PROVINCIANAC").empty().html(data);
			},"html");                 
		}
		
		//Funcion para tomar datos de ciudad a partir de provincia
		function datos_ciudad(ciudad){
			$.post("varios/get_ciudad",{ciudad:ciudad},
            function(data){
				$("#LOC_CIUDADNAC").empty().html(data);
			},"html");                 
		}
		
		//RESIDE
		//Funcion para combo de Pais en carga		 
		$('#LOC_PAISRESIDE').change(function() {
			var pais=$('#LOC_PAISRESIDE').val();
			if(pais=='OT'){
					$("#FORM_PAIS_RESIDE").val("");
					$("#FORM_PROVINCIA_RESIDE").val("");
					$("#FORM_CANTON_RESIDE").val("");
				
					$('#FORM_PAIS_RESIDE').show();
					$('#FORM_PAIS_RESIDE').attr('required',true);
					$('#FORM_PROVINCIA_RESIDE').show();
					$('#LOC_PROVINCIARESIDE').hide();
					$('#FORM_PROVINCIA_RESIDE').attr('required',true);
					$('#FORM_CANTON_RESIDE').show();
					$('#LOC_CIUDADRESIDE').hide();
					$('#FORM_CANTON_RESIDE').attr('required',true);
					$("#LOC_PROVINCIARESIDE").val("");
					$("#LOC_CIUDADRESIDE").val("");
				}else{
					$('#LOC_PROVINCIARESIDE').show();
					$('#LOC_PROVINCIARESIDE').attr('required',true);
					$('#LOC_CIUDADRESIDE').show();
					$('#LOC_CIUDADRESIDE').attr('required',true);
					
					$('#FORM_PAIS_RESIDE').hide();
					$('#FORM_PAIS_RESIDE').attr('required',false);
					$('#FORM_PROVINCIA_RESIDE').hide();
					$('#FORM_PROVINCIA_RESIDE').attr('required',false);
					$('#FORM_CANTON_RESIDE').hide();
					$('#FORM_CANTON_RESIDE').attr('required',false);
					
					$("#FORM_PAIS_RESIDE").val("");
					$("#FORM_PROVINCIA_RESIDE").val("");
					$("#FORM_CANTON_RESIDE").val("");
					
					$("#LOC_PROVINCIARESIDE").val("");
					$("#LOC_CIUDADRESIDE").val("");
					datos_provinciareside($('#LOC_PAISRESIDE').val());
				}			
		});
		
		//Funcion para combo de Provincia en carga		
		$('#LOC_PROVINCIARESIDE').change(function() {
			$("#LOC_CIUDADRESIDE").val("");
			datos_ciudadreside($('#LOC_PROVINCIARESIDE').val());
		});
				
		//Funcion para tomar datos de provincia a partir del pais
		function datos_provinciareside(pais){
			$.post("varios/get_provincia",{pais:pais},
            function(data){
				$("#LOC_PROVINCIARESIDE").empty().html(data);
			},"html");                 
		}
		
		//Funcion para tomar datos de ciudad a partir de provincia
		function datos_ciudadreside(ciudad){
			$.post("varios/get_ciudad",{ciudad:ciudad},
            function(data){
				$("#LOC_CIUDADRESIDE").empty().html(data);
			},"html");                 
		}
		
		//SUFRAGIO
		//Funcion para combo de Pais en carga		 
		$('#LOC_PAISSUFRAG').change(function() {
			var pais=$('#LOC_PAISSUFRAG').val();
			if(pais=='OT'){
					$("#FORM_PAIS_SUFRAGIO").val("");
					$("#FORM_PROVINCIA_SUFRAGIO").val("");
					$("#FORM_CANTON_SUFRAGIO").val("");
					$("#FORM_SECTOR_SUFRAGIO").val("");
				
					$('#FORM_PAIS_SUFRAGIO').show();
					$('#FORM_PAIS_SUFRAGIO').attr('required',true);
					
					$('#FORM_PROVINCIA_SUFRAGIO').show();
					$('#LOC_PROVINCIASUFRAG').hide();
					$('#FORM_PROVINCIA_SUFRAGIO').attr('required',true);
					
					$('#FORM_CANTON_SUFRAGIO').show();
					$('#LOC_CIUDADSUFRAG').hide();
					$('#FORM_CANTON_SUFRAGIO').attr('required',true);
					
					$('#FORM_SECTOR_SUFRAGIO').show();
					$('#LOC_SECTORSUFRAG').hide();
					$('#FORM_SECTOR_SUFRAGIO').attr('required',true);
					
					$("#LOC_PROVINCIASUFRAG").val("");
					$("#LOC_CIUDADSUFRAG").val("");
					$("#LOC_SECTORSUFRAG").val("");
				}else{
					$('#LOC_PROVINCIASUFRAG').show();
					$('#LOC_PROVINCIASUFRAG').attr('required',true);
					$('#LOC_CIUDADSUFRAG').show();
					$('#LOC_CIUDADSUFRAG').attr('required',true);
					$('#LOC_SECTORSUFRAG').show();
					$('#LOC_SECTORSUFRAG').attr('required',true);
					
					$('#FORM_PAIS_SUFRAGIO').hide();
					$('#FORM_PAIS_SUFRAGIO').attr('required',false);
					
					$('#FORM_PROVINCIA_SUFRAGIO').hide();
					$('#FORM_PROVINCIA_SUFRAGIO').attr('required',false);
					
					$('#FORM_CANTON_SUFRAGIO').hide();
					$('#FORM_CANTON_SUFRAGIO').attr('required',false);
					
					$('#FORM_SECTOR_SUFRAGIO').hide();
					$('#FORM_SECTOR_SUFRAGIO').attr('required',false);
					
					$("#FORM_PAIS_SUFRAGIO").val("");
					$("#FORM_PROVINCIA_SUFRAGIO").val("");
					$("#FORM_CANTON_SUFRAGIO").val("");
					$("#FORM_SECTOR_SUFRAGIO").val("");
					
					$("#LOC_PROVINCIASUFRAG").val("");
					$("#LOC_CIUDADSUFRAG").val("");
					$("#LOC_SECTORSUFRAG").val("");
					datos_provinciasufragio($('#LOC_PAISSUFRAG').val());
				}			
		});
		
		//Funcion para combo de Provincia en carga		
		$('#LOC_PROVINCIASUFRAG').change(function() {
			$("#LOC_CIUDADSUFRAG").val("");
			datos_ciudadsufragio($('#LOC_PROVINCIASUFRAG').val());
		});
		
		//Funcion para combo de Provincia en carga		
		$('#LOC_CIUDADSUFRAG').change(function() {
			$("#LOC_SECTORSUFRAG").val("");
			datos_sectorsufragio($('#LOC_CIUDADSUFRAG').val());
		});
				
		//Funcion para tomar datos de provincia a partir del pais
		function datos_provinciasufragio(pais){
			$.post("varios/get_provincia",{pais:pais},
            function(data){
				$("#LOC_PROVINCIASUFRAG").empty().html(data);
			},"html");                 
		}
		
		//Funcion para tomar datos de ciudad a partir de provincia
		function datos_ciudadsufragio(ciudad){
			$.post("varios/get_ciudad",{ciudad:ciudad},
            function(data){
				$("#LOC_CIUDADSUFRAG").empty().html(data);
			},"html");
		}
		
		//Funcion para tomar datos de ciudad a partir de provincia
		function datos_sectorsufragio(sector){
			$.post("varios/get_sector",{sector:sector},
            function(data){
				$("#LOC_SECTORSUFRAG").empty().html(data);
			},"html");                 
		}

	 
});
</script>
