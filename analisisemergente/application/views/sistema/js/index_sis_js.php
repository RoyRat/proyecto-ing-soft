<script type="text/javascript">
jQuery(document).ready(function(){
    
	var sistemas="<?php echo $sistemas; ?>";
	
	//Evento para llegar el Grid de los datos a presentar
    jQuery("#itemSis").jqGrid({
          url:"sistema/getdatosItems",
          datatype: "json",
		  colNames:["Sec.","Aplicación","Descripción","Usuarios Activos",'Usuarios','Perfiles',"Versión","Estado"],
		  colModel:[
				{name:'APP_SECUENCIAL',index:'APP_SECUENCIAL', hidden:true},
                {name:'APP_CODIGO',index:'APP_CODIGO', width:150,align:"center"},
                {name:'APP_DESCRIPCION',index:'APP_DESCRIPCION', width:200,align:"center"},
                {name:'APP_NUSUARIOS',index:'APP_NUSUARIOS', width:100,align:"center",searchable:false},
                {name:'BTNUSER',index:'BTNUSER',width:50,align:"center"},
                {name:'BTNROL',index:'BTNROL', width:50,searchable:false,align:"center",editable:true},
                {name:'APP_VERSION',index:'APP_VERSION',  width:50,align:"center"},
				{name:'APP_ESTADO',index:'APP_ESTADO',searchable:false, width:50,align:"center", edittype:'select', formatter:'select', editoptions:{value:"0:<span class='ui-icon ui-icon-circle-check ui-icon-extra'>Activo</span>;1:<span class='ui-icon ui-icon-circle-close ui-icon-extra'>Pasivo</span>"}}
         ],
        rowNum:50,
        rowList : [50,100,200,800],
        pager: '#pitemSis',
        sortname: 'APP_CODIGO',
        viewrecords: true,
        //height:350,
        width:710,
        shrinkToFit:false,
        sortorder: "asc",
        mtype:"POST",
        toolbar: [true,"top"],
            shrinkToFit:false,
            subGrid: true,
           subGridRowExpanded: function(subgrid_id, row_id) {
              var subgrid_table_id,  pager_id;
              subgrid_table_id = subgrid_id+"_t";
              pager_id = "p_"+subgrid_table_id;
              var sistema=$("#itemSis").getCell(row_id,'APP_SECUENCIAL');
              $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
              jQuery("#"+subgrid_table_id).jqGrid({
                   url:"sistema/getdirectivas/",
                   datatype: "json",
                   mtype:"POST",
                   postData:{sistema:sistema},
                   caption: "Directivas", 
                   colNames:['Sec','Descripción','Alias','Estado'],
                      colModel:[
                        {name:'USD_SECUENCIAL',index:'USD_SECUENCIAL',  hidden:true},
                        {name:'USD_DESCRIPCION',index:'USD_DESCRIPCION',   width:200},
                        {name:'USD_ALIAS',index:'USD_ALIAS',  width:100,align:"center"},
                        {name:'USD_ESTADO',index:'USD_ESTADO',searchable:false, width:50,align:"center", edittype:'select', formatter:'select', editoptions:{value:"0:<span class='ui-icon ui-icon-circle-check ui-icon-extra'>Activo</span>;1:<span class='ui-icon ui-icon-circle-close ui-icon-extra'>Pasivo</span>"}}
                    ],
                  rowNum:20,
                  sortname: 'USD_SECUENCIAL',
                  sortorder: "asc",
                  width:370,
                  shrinkToFit:false,
                  height: '100%',
                  toolbar: [true,"top"]
               });
              jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false})
              
              jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false});
							var b6="agr"+row_id;
							var b7="del"+row_id;
							var b8="act"+row_id;
                  var b4="act"+row_id;
				  //if(sistemas==1){
                //$("#t_"+subgrid_table_id).append("<button title='Agregar Directiva' id='"+b6+"'>Agregar</button>");
                //$("#t_"+subgrid_table_id).append("<button title='Bloquear Directiva' id='"+b7+"'>Bloquear</button>");
                //$("#t_"+subgrid_table_id).append("<button title='Activar Directiva' id='"+b8+"'>Activar</button>");
				  //}
				$("#"+b6).jMostrarNoGrid({
                        id:"#"+subgrid_table_id,
                        idButton:"#"+b6,
                        errorMens:"No se puede mostrar el formulario, contacte al administrador.",
                        url: "sistema/indexappdirectiva/n",
                        titulo: "Nueva Directiva: "+sistema,
                        ancho:446,
                        posicion: "top",
                        showText:true,
                        icon:"ui-icon-plusthick",
                        respuestaTipo:"html",
                        valuesIsFunction: true,
                        formAction:function(dialogId){
                          $("#frmappDirectiva").jValidacion({
                             submitAccion: function(){             
                                         var datos=$("#frmappDirectiva").serialize();
                                         $.post("sistema/addappdirectiva", datos,
                                                    function(data){
                                                         $(dialogId).html(data.mensaje);
                                                         $(dialogId).dialog({
                                                         buttons: {
                                                             "Cerrar": function(){
                                                                 $("#"+subgrid_table_id).trigger("reloadGrid");
                                                                 $(this).dialog("destroy");
                                                                 $(dialogId).remove();
                                                                 }
                                                             }
                                                         });

                                                   }, "json");
                                   },
                                   rules:{								
                                                   ACC_SEC_APLICACION : { required: true},
                                                   ACC_USUARIO: {required: true}


                                   }
                                }); 
                             $("#frmappDirectiva").submit();	
                        },
                        values:function (){	
                            return {sistema:sistema};
                        }
                    }); 
                    
                    $("#"+b7).button({
                       text: true,
                       icons: {
                           primary: "ui-icon-closethick"
                   }
                   }).click(function(evento){
                       var ids=$("#"+subgrid_table_id).getGridParam("selrow");
                        if(ids == null) {
                            alert ("Seleccione una directiva para inactivar");
                       }else {
                               if (confirm ('Esta seguro de inactivar esta directiva?')) {
                                  $.post(
                                          "sistema/delappdirectiva",
                                          {sec:ids},
                                          function(r){
                                              $("#"+subgrid_table_id).trigger("reloadGrid");
                                              if (r.cod==0){
                                                  alert(r.mensaje);
                                              }
                                              
                                          },"json");
                               }
                       }
                    });
                    
                    $("#"+b8).button({
                       text: true,
                       icons: {
                           primary: "ui-icon-check"
                   }
                   }).click(function(evento){
                       var ids=$("#"+subgrid_table_id).getGridParam("selrow");
                        if(ids == null) {
                            alert ("Seleccione una directiva para activar");
                       }else {
                               if (confirm ('Esta seguro de activar esta directiva?')) {
                                  $.post(
                                          "sistema/actappdirectiva",
                                          {sec:ids},
                                          function(r){
                                              if (r.cod==0){
                                                  alert(r.mensaje);
                                              }
                                              $("#"+subgrid_table_id).trigger("reloadGrid");
                                          },"json");
                               }
                       }
                    });
      },
      subGridRowColapsed: function(subgrid_id, row_id) {
           var subgrid_table_id; subgrid_table_id = subgrid_id+"_t";
           jQuery("#"+subgrid_table_id).remove();
        },
      gridComplete:function(){

             $(".bt1").click(function(){
                  var id=$(this).attr('data-id');
                  usuarios(id);
            });   
            
                 $(".bt2").click(function(){
                  var id=$(this).attr('data-id');
                  perfiles(id);
            });
        }         
    });
    //fin de jqgrid para usuarios
	//Botones que contendran cada evento o acción
    $("#itemSis").jqGrid('navGrid','#pitemUsr',{del:false,add:false,edit:false,refresh:true, search: false},{},{},{},{multipleSearch:true,sopt:['cn','eq']});
    $("#itemSis").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : true});
    //$("#t_itemSis").append("<button title='Nuevo Sistema' id='agr_sistema'>Nuevo</button>");
    //$("#t_itemSis").append("<button title='Editar Sistema' id='edit_sistema'>Editar</button>");
    //$("#t_itemSis").append("<button title='Ver Sistema' id='ver_sistema'>Ver</button>");
    //$("#t_itemSis").append("<button title='Anular Sistema' id='anular_sistema'>Anular</button>");  
    $("#t_itemSis").append("<button title='Recargar Sistema' id='recargar_sistema'>Refresh</button>");
	//$("#t_itemSis").append("<button title='Activar Sistema' id='activar_sistema'>Activar</button>");
    $("#t_items").append("<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>"); 
    
	//Evento en carga para cambio de selecciones
	//$("#tipo").change(function(){
       // var tipo=$("#tipo").val();
        $("#itemSis").setGridParam({datatype: "json",url:"sistema/getdatosItems",postData:{numero:''}});
        $("#itemSis").trigger('reloadGrid');		
    //});

//Evento para ingresar un nuevo usuario    
$("#agr_sistema").jMostrarNoGrid({
            id:"#t_itemSis",
            idButton:"#agr_sistema",
            errorMens:"No se puede mostrar el formulario.",
            url: "sistema/nuevoSistema",
            titulo: "Agregar un Sistema",
            alto:900,
            ancho: 1024,
            posicion: "top",
            showText:true,
            icon:"ui-icon-circle-plus",
            respuestaTipo:"html",
            values:{
                ids:null
            },
            alCerrar : function() {
                //$("#itemSis").setGridParam({datatype: "json",url:"sistema/getdatosItems",postData:{numero:$('#APP_SECUENCIAL').val()}});
                $("#itemSis").trigger('reloadGrid');
                $("#tipo").val(0);
            }
        });

//Evento para editar un usuario        
$("#edit_sistema").jMostrarNoGrid({
	        id:"#itemSis",
	        idButton:"#edit_sistema",
	        errorMens:"",
	        url: "sistema/verSistema/e",
	        titulo: "Editar Sistema",
              //  alto:900,
	        ancho:1024,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-pencil",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                values:function (){
                    var ids= $("#itemSis").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itemSis").getCell(ids,"APP_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        },
            alCerrar : function() {
                 $("#itemSis").trigger('reloadGrid');
				}
            });

//Evento para ver la informacion de un usuario			
$("#ver_sistema").jMostrarNoGrid({
	        id:"#itemSis",
	        idButton:"#ver_sistema",
	        errorMens:"",
	        url: "sistema/verSistema/v",
	        titulo: "Ver Sistema",
              //  alto:900,
	        ancho:1024,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-document-b",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                values:function (){
                    var ids= $("#itemSis").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itemSis").getCell(ids,"APP_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        }
            });
            //Actualiza la lista
            $("#itemSis").jRecargar({
                id:"#itemSis",
                showText:true,
                idButton:"#recargar_sistema",
                icon:"ui-icon-refresh"
			});
			//Actualiza la lista
            $("#itemSis").jRecargar({
                id:"#itemSis",
                showText:true,
                idButton:"#recargar_sistema",
                icon:"ui-icon-refresh"
			});

//Evento para anular un usuario
 $("#anular_sistema").jMostrarNoGrid({
	        id:"#itemSis",
	        idButton:"#anular_sistema",
	        errorMens:"",
	        url: "sistema/verSistema/x",
	        titulo: "Anular Sistema",
	        ancho:1024,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-closethick",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                botonSubmit:"Anular",
                formAction :function(dialogId){
                    var ids= $("#itemSis").getGridParam("selrow");
                    var numero=$("#itemSis").getCell(ids,"APP_SECUENCIAL");
                    $.post("sistema/anularSistema", {NUMERO:numero},
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
	                            $("#itemSis").trigger("reloadGrid");
	                        }, "json");
                },
                values:function (){
                    var ids= $("#itemSis").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itemSis").getCell(ids,"APP_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        }
            });
			
//Evento para activar un usuario
 $("#activar_sistema").jMostrarNoGrid({
	        id:"#itemSis",
	        idButton:"#activar_sistema",
	        errorMens:"",
	        url: "sistema/verSistema/d",
	        titulo: "Activar Sistema",
	        ancho:1024,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-check",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                botonSubmit:"Activar",
                formAction :function(dialogId){
                    var ids= $("#itemSis").getGridParam("selrow");
                    var numero=$("#itemSis").getCell(ids,"APP_SECUENCIAL");
                    $.post("sistema/activarSistema", {NUMERO:numero},
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
	                            $("#itemSis").trigger("reloadGrid");
	                        }, "json");
                },
                values:function (){
                    var ids= $("#itemSis").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itemSis").getCell(ids,"APP_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        }
            });

//perfiles
function perfiles(sec){
          var sistema=$("#itemSis").getCell(sec,'APP_SECUENCIAL');
          var NombreDialog = "dialog_"+$().jRand(10,100);
            $("#contenido_general").append("<div id='"+NombreDialog+"'></div>");
                         $.post( "sistema/indexrolSistema",
                               {sistema:sistema,NombreDialog:NombreDialog},
                               function(r){
                                   $("#"+NombreDialog).empty();
                                   $("#"+NombreDialog).attr("title", "Perfiles  "+sistema)
                                   .dialog({
                                       modal:true,
                                       position: "top",
                                       width:540,
                                       //height:600,
                                       closeOnEscape: false,
                                       beforeclose : function() {
                                            $('#'+NombreDialog).dialog("destroy");
                                            $('#'+NombreDialog).remove();

                                       },
                                        buttons:{
                                           "Cerrar": function() {
                                               $('#'+NombreDialog).dialog("destroy");
                                               $('#'+NombreDialog).remove();
                                           }
                                       }
                                   });
                                   console.log(NombreDialog)
                                   $("#"+NombreDialog).html(r);

                               },
                               "html"
                        );
      }

//Usuarios
function usuarios(sec){
          var sistema=$("#itemSis").getCell(sec,'APP_CODIGO');
          var NombreDialog = "dialog_"+$().jRand(10,100);
            $("#contenido_general").append("<div id='"+NombreDialog+"'></div>");
                         $.post( "usuario/index",
                               {sistema:sistema,NombreDialog:NombreDialog},
                               function(r){
                                   $("#"+NombreDialog).empty();
                                   $("#"+NombreDialog).attr("title", "Usuarios: "+sistema)
                                   .dialog({
                                       modal:true,
                                       position: 'center',
                                       width:900,
                                       height:500,
                                       closeOnEscape: false,
                                       beforeclose : function() {
                                            $('#'+NombreDialog).dialog("destroy");
                                            $('#'+NombreDialog).remove();

                                       },
                                        buttons:{
                                           "Cerrar": function() {
                                               $('#'+NombreDialog).dialog("destroy");
                                               $('#'+NombreDialog).remove();
                                           }
                                       }
                                   });
                                   console.log(NombreDialog)
                                   $("#"+NombreDialog).html(r);

                               },
                               "html"
                        );
				}	  
	
});
</script>
