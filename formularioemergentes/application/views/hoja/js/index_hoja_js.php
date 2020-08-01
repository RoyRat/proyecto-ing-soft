<script type="text/javascript">
jQuery(document).ready(function(){
        
	var aprobador='<?php echo $aprobador;?>';
	
	//Evevnto para llegar el Grid de los datos a presentar
	 jQuery("#itembga").jqGrid({
          url:"bodega/getdatosItems",
          datatype: "json",
          colNames:['Sec.','Sector','Nombre','Código','F. Ingreso','Resp. Ing.','F. Actualiza','Resp. Act.','Observaciones','Estado'],
          colModel:[
                        {name:'BGA_SECUENCIAL',index:'BGA_SECUENCIAL',align:"center",width:30},
                        {name:'BGA_SEC_LUGAR',index:'BGA_SEC_LUGAR',align:"center",width:150},
                        {name:'BGA_NOMBRE',index:'BGA_NOMBRE',align:"center",width:100},
                        {name:'BGA_CODIGO',index:'BGA_CODIGO',align:"center",width:100},
                        {name:'BGA_FECHAINGRESO',index:'BGA_FECHAINGRESO',align:"center",width:100},
                        {name:'BGA_RESPING',index:'BGA_RESPING',align:"center",width:100},
                        {name:'BGA_FECHAACTUALIZA',index:'BGA_FECHAACTUALIZA',align:"center",width:100},
                        {name:'BGA_RESPACT',index:'BGA_RESPACT',align:"center",width:100},
                        {name:'BGA_OBSERVACION',index:'BGA_OBSERVACION',align:"justify",width:250},
						{name:'BGA_ESTADO',index:'BGA_ESTADO',searchable:false, width:50,align:"center", edittype:'select', formatter:'select', editoptions:{value:"0:<span class='ui-icon ui-icon-circle-check ui-icon-extra'>Activo</span>;1:<span class='ui-icon ui-icon-circle-close ui-icon-extra'>Pasivo</span>"}}
                    ],
        rowNum:50,
        rowList : [50,100,200,800],
        pager: '#pitembga',
        sortname: 'BGA_SECUENCIAL',
        viewrecords: true,
        height:300,
        width:820,
        shrinkToFit:false,
        sortorder: "asc",
        mtype:"POST",
        toolbar: [true,"top"]
    });
	    
	//Botones que contendran cada evento o acción
    $("#itembga").jqGrid('navGrid','#pitembga',{del:false,add:false,edit:false,refresh:true, search: false},{},{},{},{multipleSearch:true,sopt:['cn','eq']});
    $("#itembga").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : true});
    $("#t_itembga").append("<button title='Nueva Bodega' id='agr_bodega'>Nueva</button>");
    $("#t_itembga").append("<button title='Editar Bodega' id='edit_bodega'>Editar</button>");
    $("#t_itembga").append("<button title='Ver Bodega' id='ver_bodega'>Ver</button>");    
    $("#t_itembga").append("<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>");
	$("#t_itembga").append("<button title='Recargar Listas' id='recargar_lista'>Refresh</button>");    
	$("#t_itembga").append("<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>");
	$("#t_itembga").append("<button title='Eliminar Bodega' id='anular_bodega'>Anular</button>");
	$("#t_itembga").append("<button title='Activar Bodega' id='activar_bodega'>Activar</button>");
    
	//Evento en carga para cambio de selecciones
	//$("#tipo").change(function(){
        //var tipo=$("#tipo").val();
        $("#itembga").setGridParam({datatype: "json",url:"bodega/getdatosItems",postData:{numero:''}});
        $("#itembga").trigger('reloadGrid');		
    //});

//Evento para ingresar un nuevo registro    
$("#agr_bodega").jMostrarNoGrid({
            id:"#t_itembga",
            idButton:"#agr_bodega",
            errorMens:"No se puede mostrar el formulario.",
            url: "bodega/nuevaBodega/",
            titulo: "Agregar Bodega",
            ancho: 680,
            posicion: "top",
            showText:true,
            icon:"ui-icon-plusthick",
            respuestaTipo:"html",
            values:{
                ids:null
            },
            alCerrar : function() {
                $("#itembga").setGridParam({datatype: "json",url:"bodega/getdatosItems",postData:{numero:$('#BGA_SECUENCIAL').val()}});
                $("#itembga").trigger('reloadGrid');
            }
        });

//Evento para editar un registro        
$("#edit_bodega").jMostrarNoGrid({
	        id:"#itembga",
	        idButton:"#edit_bodega",
	        errorMens:"",
	        url: "bodega/verBodega/e",
	        titulo: "Editar Bodega",
              //  alto:900,
	        ancho:680,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-pencil",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                values:function (){
                    var ids= $("#itembga").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itembga").getCell(ids,"BGA_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        },
            alCerrar : function() {
                 $("#itembga").trigger('reloadGrid');
            }
            });

//Evento para ver la informacion de un registro			
$("#ver_bodega").jMostrarNoGrid({
	        id:"#itembga",
	        idButton:"#ver_bodega",
	        errorMens:"",
	        url: "bodega/verBodega/v",
	        titulo: "Ver Bodega",
              //  alto:900,
	        ancho:680,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-document-b",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                values:function (){
                    var ids= $("#itembga").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itembga").getCell(ids,"BGA_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        }
            });
            //Actualiza lista
            $("#itembga").jRecargar({
                id:"#itembga",
                showText:true,
                idButton:"#recargar_lista",
                icon:"ui-icon-refresh"
});            
			//Actualiza lista
            $("#itembga").jRecargar({
                id:"#itembga",
                showText:true,
                idButton:"#recargar_lista",
                icon:"ui-icon-refresh"
});

//Evento para eliminar un registro
 $("#anular_bodega").jMostrarNoGrid({
	        id:"#itembga",
	        idButton:"#anular_bodega",
	        errorMens:"",
	        url: "bodega/verBodega/x",
	        titulo: "Eliminar Bodega",
	        ancho:680,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-closethick",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                botonSubmit:"Eliminar",
                formAction :function(dialogId){
                    var ids= $("#itembga").getGridParam("selrow");
                    var numero=$("#itembga").getCell(ids,"BGA_SECUENCIAL");
                    $.post("bodega/anularBodega", {NUMERO:numero},
	                        function(data){
	                            $(dialogId).html(data.mensaje);
	                            $(dialogId).dialog({
	                            buttons: {
	                                "Cerrar": function(){
	                                    $(this).dialog("destroy");
	                                    $(dialogId).remove();
	                                    }
	                                }
	                            });
	                            $("#itembga").trigger("reloadGrid");
	                        }, "json");
                },
                values:function (){
                    var ids= $("#itembga").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itembga").getCell(ids,"BGA_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        }
            });

//Evento para activar un registro
 $("#activar_bodega").jMostrarNoGrid({
	        id:"#itembga",
	        idButton:"#activar_bodega",
	        errorMens:"",
	        url: "bodega/verBodega/a",
	        titulo: "Activar Bodega",
	        ancho:680,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-check",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                botonSubmit:"Activar",
                formAction :function(dialogId){
                    var ids= $("#itembga").getGridParam("selrow");
                    var numero=$("#itembga").getCell(ids,"BGA_SECUENCIAL");
                    $.post("bodega/activarBodega", {NUMERO:numero},
	                        function(data){
	                            $(dialogId).html(data.mensaje);
	                            $(dialogId).dialog({
	                            buttons: {
	                                "Cerrar": function(){
	                                    $(this).dialog("destroy");
	                                    $(dialogId).remove();
	                                    }
	                                }
	                            });
	                            $("#itembga").trigger("reloadGrid");
	                        }, "json");
                },
                values:function (){
                    var ids= $("#itembga").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itembga").getCell(ids,"BGA_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        }
            });
	
});
</script>
