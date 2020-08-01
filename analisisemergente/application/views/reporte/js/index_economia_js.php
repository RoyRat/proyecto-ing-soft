<script type="text/javascript">
jQuery(document).ready(function(){

//Estilos para index
	$("table.formDialog tr th,table.formDialog caption").addClass("ui-widget ui-widget-header");
    $("table.formDialog tr td").addClass("ui-widget ui-widget-content");
    $("table.formDialog tr td.noClass").removeClass("ui-widget ui-widget-content");
    
	//Variables de permisos de usuarios
	var usuario="<?php echo $usuario; ?>";
	
	//Funcion para rango de fecha final
	//Fecha Actual
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1;
		var yyyy = today.getFullYear();
			if(dd<10){
				dd='0'+dd
			} 
			if(mm<10){
				mm='0'+mm
			}
		var today = dd+'-'+mm+'-'+yyyy; //variable fecha actual
		
 function rangoFecha(input){
    return {
        maxDate: today
		}
    }

//Formato para fechas
jQuery("#SD_FECHA_INGRESOINI,#SD_FECHA_INGRESOFIN").datepicker({
        dateFormat: 'dd-mm-yy',
		beforeShow: rangoFecha
    });

//Evento para multiselect de fases
$("#itemSalud2 select").chosen({no_results_text: "No existen resultados de búsqueda.",placeholder_text_multiple:"Seleciona una o varias opciones",placeholder_text_single:"Selecciona una opción",width: "300px"});
 	
	//Grid para informacion de recepcion
    jQuery("#itemSalud").jqGrid({
          url:"reporte/getSalud",
          datatype: "json",
          colNames:['Sec.','Tipo Doc.','Cédula','Apellidos','Nombres','Fecha Nacimiento','Celular','Convencional','Correo',
					'Pais Nac.','Provincia Nac.','Cantón Nac.','Pais Reside','Provincia Reside','Cantón Reside',
					'Pais Sufragio','Provincia Sufragio','Cantón Sufragio','Sector Sufragio','Genero','Estado Civil',
					'Tipo Sangre','Cargo Discapacitado','Posee Discap.','% Discap.','Carné Discap.','Tipo Discap.',
					'Posee Enfermedad','Enfermedad Des.','Posee Alergia','Alergia Des.','Toma Medicación','Emdicación Des.',
					'# Farmacias','# Hospitales/Clinicas','Cerca MSP','Fecha Ing.','Estado'],
          colModel:[
                    {name:'SD_SECUENCIAL',index:'SD_SECUENCIAL',align:"center", width:50,classes:"fuera",hidden:true},
					{name:'SD_TIPODOCUMENTO',index:'SD_TIPODOCUMENTO',align:'center', width:100,classes:'fuera'},
					{name:'SD_CEDULA',index:'SD_CEDULA',align:'center', width:100,classes:'fuera'},
					{name:'SD_APELLIDOS',index:'SD_APELLIDOS',align:'center', width:100,classes:'fuera'},
					{name:'SD_NOMBRES',index:'SD_NOMBRES',align:'center', width:100,classes:'fuera'},
					{name:'SD_FECHA_NACIMIENTO',index:'SD_FECHA_NACIMIENTO',align:'center', width:100,classes:'fuera'},
					{name:'SD_CELULAR',index:'SD_CELULAR',align:'center', width:100,classes:'fuera'},
					{name:'SD_CONVENCIONAL',index:'SD_CONVENCIONAL',align:'center', width:100,classes:'fuera'},
					{name:'SD_CORREO',index:'SD_CORREO',align:'center', width:100,classes:'fuera'},
					{name:'SD_PAIS_NACIMIENTO',index:'SD_PAIS_NACIMIENTO',align:'center', width:100,classes:'fuera'},
					{name:'SD_PROVINCIA_NACIMIENTO',index:'SD_PROVINCIA_NACIMIENTO',align:'center', width:100,classes:'fuera'},
					{name:'SD_CANTON_NACIMIENTO',index:'SD_CANTON_NACIMIENTO',align:'center', width:100,classes:'fuera'},
					{name:'SD_PAIS_RESIDE',index:'SD_PAIS_RESIDE',align:'center', width:100,classes:'fuera'},
					{name:'SD_PROVINCIA_RESIDE',index:'SD_PROVINCIA_RESIDE',align:'center', width:100,classes:'fuera'},
					{name:'SD_CANTON_RESIDE',index:'SD_CANTON_RESIDE',align:'center', width:100,classes:'fuera'},
					{name:'SD_PAIS_SUFRAGIO',index:'SD_PAIS_SUFRAGIO',align:'center', width:100,classes:'fuera'},
					{name:'SD_PROVINCIA_SUFRAGIO',index:'SD_PROVINCIA_SUFRAGIO',align:'center', width:100,classes:'fuera'},
					{name:'SD_CANTON_SUFRAGIO',index:'SD_CANTON_SUFRAGIO',align:'center', width:100,classes:'fuera'},
					{name:'SD_SECTOR_SUFRAGIO',index:'SD_SECTOR_SUFRAGIO',align:'center', width:100,classes:'fuera'},
					{name:'SD_GENERO',index:'SD_GENERO',align:'center', width:100,classes:'fuera'},
					{name:'SD_ESTADO_CIVIL',index:'SD_ESTADO_CIVIL',align:'center', width:100,classes:'fuera'},
					{name:'SD_TIPO_SANGRE',index:'SD_TIPO_SANGRE',align:'center', width:100,classes:'fuera'},
					{name:'SD_CARGO_DISCAPACITADO',index:'SD_CARGO_DISCAPACITADO',align:'center', width:100,classes:'fuera'},
					{name:'SD_POSEE_DISCPACIDAD',index:'SD_POSEE_DISCPACIDAD',align:'center', width:100,classes:'fuera'},
					{name:'SD_PORCENTAJE_DISCAP',index:'SD_PORCENTAJE_DISCAP',align:'center', width:100,classes:'fuera'},
					{name:'SD_CARNE_CONADIS',index:'SD_CARNE_CONADIS',align:'center', width:100,classes:'fuera'},
					{name:'SD_TIPO_DISCAP',index:'SD_TIPO_DISCAP',align:'center', width:100,classes:'fuera'},
					{name:'SD_POSEE_ENFERMEDAD',index:'SD_POSEE_ENFERMEDAD',align:'center', width:100,classes:'fuera'},
					{name:'SD_ENFERMEDADDES',index:'SD_ENFERMEDADDES',align:'center', width:100,classes:'fuera'},
					{name:'SD_POSEE_ALERGIA',index:'SD_POSEE_ALERGIA',align:'center', width:100,classes:'fuera'},
					{name:'SD_ALERGIADES',index:'SD_ALERGIADES',align:'center', width:100,classes:'fuera'},
					{name:'SD_POSEE_MEDICACION',index:'SD_POSEE_MEDICACION',align:'center', width:100,classes:'fuera'},
					{name:'SD_MEDICACIONDES',index:'SD_MEDICACIONDES',align:'center', width:100,classes:'fuera'},
					{name:'SD_NUM_FARMACIAS',index:'SD_NUM_FARMACIAS',align:'center', width:100,classes:'fuera'},
					{name:'SD_NUM_HOSPITALES',index:'SD_NUM_HOSPITALES',align:'center', width:100,classes:'fuera'},
					{name:'SD_CERCA_MSP',index:'SD_CERCA_MSP',align:'center', width:100,classes:'fuera'},
					{name:'SD_FECHA_INGRESO',index:'SD_FECHA_INGRESO',align:'center', width:100,classes:'fuera'},
					{name:'SD_ESTADO',index:'SD_ESTADO',searchable:false, width:50,align:"center", edittype:'select', formatter:'select', editoptions:{value:"0:<span class='ui-icon ui-icon-circle-check ui-icon-extra'>Activo</span>;1:<span class='ui-icon ui-icon-circle-close ui-icon-extra'>Pasivo</span>"}}
                ],
        rowNum:50,
        rowList : [50,100,200,1000,3000],
        pager: '#pitemSalud',
        sortname: 'SD_FECHA_INGRESO',
        viewrecords: true,
        height:220,
        width:1000,
        shrinkToFit:false,
        sortorder: "asc",
        mtype:"POST",
		multiselect: true,
        toolbar: [true,"top"]

    });
    
    $("#itemSalud").jqGrid('navGrid','#pitemSalud',{del:false,add:false,edit:false,refresh:true, search: false},{},{},{},{multipleSearch:true,sopt:['cn','eq']});
    $("#itemSalud").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : true});
	$("#t_itemSalud").append("<button title='Imprimir Reporte PDF' id='imprimir_pdf'>Reporte PDF</button>");
    $("#t_itemSalud").append("<button title='Recargar Recepción' id='recargar_rcp'>Refresh</button>");
	$("#t_itemSalud").append("<button title='Mostrar Barras Docentes' id='indicador_img'>Imagen indicador</button>");
    
	$("#SD_FECHA_INGRESOINI,#SD_FECHA_INGRESOFIN,#cmbgenero,#cmbtiposangre,#cmbcargodiscapacitado,#cmbdiscapacitado,#cmbtipodiscapacidad,#cmbenfermedad,#cmbalergias,#cmbmedicacion,#cmbcercamsp,#SD_NUM_FARMACIAS,#SD_NUM_HOSPITALES").change(function(){
        
		var SD_FECHA_INGRESOINI=$("#SD_FECHA_INGRESOINI").val();
		var SD_FECHA_INGRESOFIN=$("#SD_FECHA_INGRESOFIN").val();
		var cmbgenero=$("#cmbgenero").val();
		var cmbtiposangre=$("#cmbtiposangre").val();
		var cmbcargodiscapacitado=$("#cmbcargodiscapacitado").val();
		var cmbdiscapacitado=$("#cmbdiscapacitado").val();
		var cmbtipodiscapacidad=$("#cmbtipodiscapacidad").val();
		var cmbenfermedad=$("#cmbenfermedad").val();
		var cmbalergias=$("#cmbalergias").val();
		var cmbmedicacion=$("#cmbmedicacion").val();
		var cmbcercamsp=$("#cmbcercamsp").val();
		var SD_NUM_FARMACIAS=$("#SD_NUM_FARMACIAS").val();
		var SD_NUM_HOSPITALES=$("#SD_NUM_HOSPITALES").val();
		$("#itemSalud").setGridParam({datatype: "json",url:"reporte/getSalud",postData:{numero:'',SD_FECHA_INGRESOINI:SD_FECHA_INGRESOINI,
																						SD_FECHA_INGRESOFIN:SD_FECHA_INGRESOFIN,cmbgenero:cmbgenero,
																						cmbtiposangre:cmbtiposangre,cmbcargodiscapacitado:cmbcargodiscapacitado,
																						cmbdiscapacitado:cmbdiscapacitado,cmbtipodiscapacidad:cmbtipodiscapacidad,
																						cmbenfermedad:cmbenfermedad,cmbalergias:cmbalergias,
																						cmbmedicacion:cmbmedicacion,cmbcercamsp:cmbcercamsp,
																						SD_NUM_FARMACIAS:SD_NUM_FARMACIAS,SD_NUM_HOSPITALES:SD_NUM_HOSPITALES}});
        $("#itemSalud").trigger('reloadGrid');
    });
            
            $("#itemSalud").jRecargar({
                id:"#itemSalud",
                showText:true,
                idButton:"#recargar_rcp",
                icon:"ui-icon-refresh"
			});
            
            $("#itemSalud").jRecargar({
                id:"#itemSalud",
                showText:true,
                idButton:"#recargar_rcp",
                icon:"ui-icon-refresh"
			});

//PDF
$("#imprimir_pdf").button({
				icons:{
					primary: "ui-icon-print"
				}
			}).click(function(evento){
					var ids = jQuery("#itemSalud").jqGrid('getGridParam','selarrrow');
					var SD_FECHA_INGRESOINI=$("#SD_FECHA_INGRESOINI").val();
					var SD_FECHA_INGRESOFIN=$("#SD_FECHA_INGRESOFIN").val();
					var cmbgenero=$("#cmbgenero").val();
					var cmbtiposangre=$("#cmbtiposangre").val();
					var cmbcargodiscapacitado=$("#cmbcargodiscapacitado").val();
					var cmbdiscapacitado=$("#cmbdiscapacitado").val();
					var cmbtipodiscapacidad=$("#cmbtipodiscapacidad").val();
					var cmbenfermedad=$("#cmbenfermedad").val();
					var cmbalergias=$("#cmbalergias").val();
					var cmbmedicacion=$("#cmbmedicacion").val();
					var cmbcercamsp=$("#cmbcercamsp").val();
					var SD_NUM_FARMACIAS=$("#SD_NUM_FARMACIAS").val();
					var SD_NUM_HOSPITALES=$("#SD_NUM_HOSPITALES").val();
						$.post("reporte/fmtSaludPdf", {numero:ids,SD_FECHA_INGRESOINI:SD_FECHA_INGRESOINI,
																						SD_FECHA_INGRESOFIN:SD_FECHA_INGRESOFIN,cmbgenero:cmbgenero,
																						cmbtiposangre:cmbtiposangre,cmbcargodiscapacitado:cmbcargodiscapacitado,
																						cmbdiscapacitado:cmbdiscapacitado,cmbtipodiscapacidad:cmbtipodiscapacidad,
																						cmbenfermedad:cmbenfermedad,cmbalergias:cmbalergias,
																						cmbmedicacion:cmbmedicacion,cmbcercamsp:cmbcercamsp,
																						SD_NUM_FARMACIAS:SD_NUM_FARMACIAS,SD_NUM_HOSPITALES:SD_NUM_HOSPITALES},
						function(data){
								 var dialogId= "dialog_"+$().jRand(10,100);
								$("#d_consultaSalud").append("<div id='"+dialogId+"'></div>");
								$("#"+dialogId).html(data.mensaje);
								$("#"+dialogId).dialog(
								{
										modal:true,
										position: "top",
										width:1040,
										height:780,
										closeOnEscape: false,
										beforeclose : function() {
											 $('#'+dialogId).dialog("destroy");
											 $('#'+dialogId).remove();
										}
								}
									);
							}
							, "json");
					
			});
			
//Evento para mostrar grafica  
$("#indicador_img").jMostrarNoGrid({
            id:"#t_itemSalud",
            idButton:"#indicador_img",
            errorMens:"No se puede mostrar el formulario.",
            url: "reporte/imagenSalud/",
            titulo: "Imagen Salud",
            ancho: 1250,
            posicion: "top",
            showText:true,
            icon:"ui-icon-image",
            respuestaTipo:"html",
            valuesIsFunction: true,
                values:function (){
					var SD_FECHA_INGRESOINI=$("#SD_FECHA_INGRESOINI").val();
					var SD_FECHA_INGRESOFIN=$("#SD_FECHA_INGRESOFIN").val();
					var cmbgenero=$("#cmbgenero").val();
					var cmbtiposangre=$("#cmbtiposangre").val();
					var cmbcargodiscapacitado=$("#cmbcargodiscapacitado").val();
					var cmbdiscapacitado=$("#cmbdiscapacitado").val();
					var cmbtipodiscapacidad=$("#cmbtipodiscapacidad").val();
					var cmbenfermedad=$("#cmbenfermedad").val();
					var cmbalergias=$("#cmbalergias").val();
					var cmbmedicacion=$("#cmbmedicacion").val();
					var cmbcercamsp=$("#cmbcercamsp").val();
					var SD_NUM_FARMACIAS=$("#SD_NUM_FARMACIAS").val();
					var SD_NUM_HOSPITALES=$("#SD_NUM_HOSPITALES").val();
					return {SD_FECHA_INGRESOINI:SD_FECHA_INGRESOINI,
							SD_FECHA_INGRESOFIN:SD_FECHA_INGRESOFIN,cmbgenero:cmbgenero,
							cmbtiposangre:cmbtiposangre,cmbcargodiscapacitado:cmbcargodiscapacitado,
							cmbdiscapacitado:cmbdiscapacitado,cmbtipodiscapacidad:cmbtipodiscapacidad,
							cmbenfermedad:cmbenfermedad,cmbalergias:cmbalergias,
							cmbmedicacion:cmbmedicacion,cmbcercamsp:cmbcercamsp,
							SD_NUM_FARMACIAS:SD_NUM_FARMACIAS,SD_NUM_HOSPITALES:SD_NUM_HOSPITALES};
	        },
            alCerrar : function() {}
        });	
			
});
</script>
