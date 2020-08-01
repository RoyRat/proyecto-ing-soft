<script type="text/javascript">
jQuery(document).ready(function(){
    
	//Evento para llegar el Grid de los datos a presentar	
    jQuery("#itemUsr").jqGrid({
          url:"usuario/getdatosItems/0",
          datatype: "json",
		  colNames:['Sec.','Localización','Cedula','Código','Nombres','Apellidos','Correo','Fecha Creación','Estado'],
          colModel:[
                    {name:'US_SECUENCIAL',index:'US_SECUENCIAL',align:"center",width:30},
                    {name:'US_LOCALIZACION',index:'US_LOCALIZACION',align:"center", width:80, hidden:true},
					{name:'US_CEDULA',index:'US_CEDULA', width:80, align:"center"},					
					{name:'US_CODIGO',index:'US_CODIGO', width:100,align:"center"},
					{name:'US_NOMBRES',index:'US_NOMBRES', width:200,align:"center", hidden:false},
					{name:'US_APELLIDOS',index:'US_APELLIDOS', width:200,align:"center"},
					{name:'US_MAIL',index:'US_MAIL', width:200,align:"center"},
					{name:'US_FECHACREACION',index:'US_FECHACREACION', width:125,align:"center"},
					{name:'US_ESTADO',index:'US_ESTADO',search:false, width:40,align:"center", edittype:'select', formatter:'select', editoptions:{value:"0:<span class='ui-icon ui-icon-circle-check ui-icon-extra'>Activo</span>;1:<span class='ui-icon ui-icon-circle-close ui-icon-extra'>Pasivo</span>"}}
                ],
        rowNum:50,
        rowList : [50,100,200,800],
        pager: '#pitemUsr',
        sortname: 'US_SECUENCIAL',
        viewrecords: true,
        height:255,
        width:1050,
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
                  var user=$("#itemUsr").getCell(row_id,'US_SECUENCIAL');
                  $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
                  jQuery("#"+subgrid_table_id).jqGrid({
                       url:"usuario/getSistemasUser",
                        datatype: "json",
                        colNames:["",'Sec. App',"Aplicación","Rol","Fecha Creación","Creado Por","Estado"],
                        mtype:"POST",
                        postData:{user:user},
						caption: "Aplicaciones Asignadas", 
                        colModel:[
                                {name:'ACC_SECUENCIAL',index:'ACC_SECUENCIAL', hidden:true},
                                {name:'ACC_SEC_APLICACION',index:'ACC_SEC_APLICACION', width:60,align:"center", hidden:true},
                                {name:'APP_CODIGO',index:'APP_CODIGO', width:100,align:"center"},                                
                                {name:'USR_DESCRIPCION',index:'USR_DESCRIPCION', width:150,align:"center"},
                                {name:'ACC_FECHAINGRESO',index:'ACC_FECHAINGRESO', width:95,align:"center"},
                                {name:'ACC_CREADOPOR',index:'ACC_CREADOPOR', width:100,align:"center",hidden:false},
								{name:'ACC_ESTADO',index:'ACC_ESTADO',searchable:false, width:40,align:"center", edittype:'select', formatter:'select', editoptions:{value:"0:<span class='ui-icon ui-icon-circle-check ui-icon-extra'>Activo</span>;1:<span class='ui-icon ui-icon-circle-close ui-icon-extra'>Pasivo</span>"}}
                         ],
                        rowNum:100,
                        sortname: 'ACC_SEC_APLICACION',
                        sortorder: "asc",
                        width:510,
                        shrinkToFit:false,
                        height: '75',
                        toolbar: [true,"top"]
                   });
                  jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false});
                  jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:true,add:true,del:false,search:false});
                  var b1="agr"+row_id;
                  var b3="edit"+row_id;
                  var b2="del"+row_id;
                  var b4="act"+row_id;
                $("#t_"+subgrid_table_id)
										.append("<button title='Agregar Aplicación' id='"+b1+"'>Agregar</button>")
										.append("<button title='Editar Aplicación' id='"+b3+"'>Editar</button>")
										.append("<button title='Bloquear Aplicación' id='"+b2+"'>Bloquear</button>")
										.append("<button title='Activar Aplicación' id='"+b4+"'>Activar</button>");
                $("#"+b1).jMostrarNoGrid({
                        id:"#"+subgrid_table_id,
                        idButton:"#"+b1,
                        errorMens:"No se puede mostrar el formulario, contacte al administrador.",
                        url: "usuario/indexuseraplicacion/n",
                        titulo: "Sistemas Usuario",
                        ancho:600,
                        posicion: "top",
                        showText:true,
                        icon:"ui-icon-plusthick",
                        respuestaTipo:"html",
                        valuesIsFunction: true,
                        formAction:function(dialogId){
                          $("#frmUserapp").jValidacion({
                             submitAccion: function(){             
                                         var datos=$("#frmUserapp").serialize();
                                         $.post("usuario/addappuser", datos,
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
                             $("#frmUserapp").submit();	
                        },
                        values:function (){	
                            return {US_SECUENCIAL:user};
                        }
                    }); 
                    
                     $("#"+b3).jMostrarNoGrid({
                        id:"#"+subgrid_table_id,
                        idButton:"#"+b3,
                        errorMens:"No se puede mostrar el formulario, contacte al administrador.",
                        url: "usuario/indexuseraplicacion/e",
                        titulo: "Edición Sistema Usuario",
                        ancho:600,
                        posicion: "top",
                        showText:true,
                        icon:"ui-icon-pencil",
                        respuestaTipo:"html",
                        valuesIsFunction: true,
                        formAction:function(dialogId){
                          $("#frmUserapp").jValidacion({
                             submitAccion: function(){             
                                         var datos=$("#frmUserapp").serialize();
                                         $.post("usuario/editappuser", datos,
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
                                                   ACC_SEC_APLICACION :      { required: true},
                                                   ACC_USUARIO:     {required: true}


                                   }
                                }); 
                             $("#frmUserapp").submit();	
                        },
                        values:function (){	
                            return {US_SECUENCIAL:user,ACC_SECUENCIAL:$("#"+subgrid_table_id).jqGrid('getGridParam', 'selrow') };
                        }
                    });
                    
             $("#"+b2).button({
                       text: true,
                       icons: {
                           primary: "ui-icon-closethick"
                   }
                   }).click(function(evento){
                       var ids=$("#"+subgrid_table_id).getGridParam("selrow");
                        if(ids == null) {
                            alert ("Seleccione una aplicacion de este usuario para inactivar");
                       }else {
                               if (confirm ('Esta seguro de inactivar esta apliacacion?')) {
                                  $.post(
                                          "usuario/delappuser",
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
                    
                    $("#"+b4).button({
                       text: true,
                       icons: {
                           primary: "ui-icon-check"
                   }
                   }).click(function(evento){
                       var ids=$("#"+subgrid_table_id).getGridParam("selrow");
                        if(ids == null) {
                            alert ("Seleccione una aplicacion de este usuario para activar");
                       }else {
                               if (confirm ('Esta seguro de activar esta apliacacion?')) {
                                  $.post(
                                          "usuario/actappuser",
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

            },subGridRowColapsed: function(subgrid_id, row_id) {
                 var subgrid_table_id; subgrid_table_id = subgrid_id+"_t";
                 jQuery("#"+subgrid_table_id).remove();
              },
              gridComplete:function(){

             $(".bt1").click(function(){
                  var id=$(this).attr('data-id');
            });   
            

        } 
    });
    //fin de jqgrid para usuarios
	//Botones que contendran cada evento o acción
    $("#itemUsr").jqGrid('navGrid','#pitemUsr',{del:false,add:false,edit:false,refresh:true, search: false},{},{},{},{multipleSearch:true,sopt:['cn','eq']});
    $("#itemUsr").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : true});
    $("#t_itemUsr").append("<button title='Nuevo Usuario' id='agr_usuario'>Nuevo</button>");
    $("#t_itemUsr").append("<button title='Editar Usuario' id='edit_usuario'>Editar</button>");
    $("#t_itemUsr").append("<button title='Ver Usuario' id='ver_usuario'>Ver</button>");
	$("#t_itemUsr").append("<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>"); 
    $("#t_itemUsr").append("<button title='Activar Usuario' id='activar_usuario'>Activar</button>");
	$("#t_itemUsr").append("<button title='Anular Usuario' id='anular_usuario'>Anular</button>");  
    $("#t_itemUsr").append("<button title='Recargar Usuarios' id='recargar_usuario'>Refresh</button>");	
	$("#t_itemUsr").append("<button title='Resetear Clave de Usuario' id='resetclave'>Resetear</button>");    
    
	//Evento en carga para cambio de selecciones
        $("#itemUsr").setGridParam({datatype: "json",url:"usuario/getdatosItems",postData:{numero:''}});
        $("#itemUsr").trigger('reloadGrid');		

//Evento para ingresar un nuevo usuario    
$("#agr_usuario").jMostrarNoGrid({
            id:"#t_itemUsr",
            idButton:"#agr_usuario",
            errorMens:"No se puede mostrar el formulario.",
            url: "usuario/nuevoUsuario",
            titulo: "Agregar Usuario",
            //alto:800,
            ancho: 815,
            posicion: "top",
            showText:true,
            icon:"ui-icon-plusthick",
            respuestaTipo:"html",
            values:{
                ids:null
            },
            alCerrar : function() {
                $("#itemUsr").trigger('reloadGrid');
                $("#tipo").val(0);
            }
        });

//Evento para editar un usuario        
$("#edit_usuario").jMostrarNoGrid({
	        id:"#itemUsr",
	        idButton:"#edit_usuario",
	        errorMens:"",
	        url: "usuario/verUsuario/e",
	        titulo: "Editar Usuario",
            //alto:800,
            ancho: 815,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-pencil",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                values:function (){
                    var ids= $("#itemUsr").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itemUsr").getCell(ids,"US_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        },
            alCerrar : function() {
                 $("#itemUsr").trigger('reloadGrid');
            }
            });

//Evento para ver la informacion de un usuario			
$("#ver_usuario").jMostrarNoGrid({
	        id:"#itemUsr",
	        idButton:"#ver_usuario",
	        errorMens:"",
	        url: "usuario/verUsuario/v",
	        titulo: "Ver Usuario",
            //alto:800,
            ancho: 815,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-document-b",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                values:function (){
                    var ids= $("#itemUsr").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itemUsr").getCell(ids,"US_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        }
            });
            //Actualiza la lista
            $("#itemUsr").jRecargar({
                id:"#itemUsr",
                showText:true,
                idButton:"#recargar_usuario",
                icon:"ui-icon-refresh"
});            
			//Actualiza la lista
            $("#itemUsr").jRecargar({
                id:"#itemUsr",
                showText:true,
                idButton:"#recargar_usuario",
                icon:"ui-icon-refresh"
});

//Evento para anular un usuario
 $("#anular_usuario").jMostrarNoGrid({
	        id:"#itemUsr",
	        idButton:"#anular_usuario",
	        errorMens:"",
	        url: "usuario/verUsuario/x",
	        titulo: "Eliminar Usuario",
	        //alto:800,
            ancho: 815,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-closethick",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                botonSubmit:"Eliminar",
                formAction :function(dialogId){
                    var ids= $("#itemUsr").getGridParam("selrow");
                    var numero=$("#itemUsr").getCell(ids,"US_SECUENCIAL");
                    $.post("usuario/anularUsuario", {NUMERO:numero},
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
	                            $("#itemUsr").trigger("reloadGrid");
	                        }, "json");
                },
                values:function (){
                    var ids= $("#itemUsr").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itemUsr").getCell(ids,"US_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        }
            });
			
//Evento para activar un usuario
 $("#activar_usuario").jMostrarNoGrid({
	        id:"#itemUsr",
	        idButton:"#activar_usuario",
	        errorMens:"",
	        url: "usuario/verUsuario/d",
	        titulo: "Activar Usuario",
	        //alto:800,
            ancho: 815,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-check",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
                botonSubmit:"Activar",
                formAction :function(dialogId){
                    var ids= $("#itemUsr").getGridParam("selrow");
                    var numero=$("#itemUsr").getCell(ids,"US_SECUENCIAL");
                    $.post("usuario/activarUsuario", {NUMERO:numero},
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
	                            $("#itemUsr").trigger("reloadGrid");
	                        }, "json");
                },
                values:function (){
                    var ids= $("#itemUsr").getGridParam("selrow");
	            if ($().jEmpty(ids)){
	                return {ids:null};
	            }else{
                        var numero=$("#itemUsr").getCell(ids,"US_SECUENCIAL");
	                return {NUMERO:numero};
	            };
	        }
            });

//Resetear Clave 
$("#resetclave").button({
        text: true,
        icons:{
            primary: "ui-icon-key"
        }
    }).click(function(){
        var NombreDialog = "dialog_"+$().jRand(10,100);
        $("body").append("<div id='"+NombreDialog+"'></div>");
        var ids=$("#itemUsr").getGridParam("selrow");

        if(ids == null) {
            $( "#"+NombreDialog ).load("usuario/errorSeleccion").attr('title','Error').dialog({
                resizable: false, 
                modal: true,
                beforeclose : function() {
                        $("#itemUsr").trigger("reloadGrid");
                        $(this).delay(3000).queue(function() {
                                $(this).fadeOut("slow");
                                $(this).dialog("destroy");
                            });
                },
                buttons: {
                    "Cerrar": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        }else {
            var codigo= $("#itemUsr").getCell(ids,'US_SECUENCIAL');
            var mail= $("#itemUsr").getCell(ids,'US_MAIL');
			if(codigo!="S/C"){
        if (confirm ('Esta seguro de resetear la clave para '+codigo+'...?')) {
            $( "#"+NombreDialog ).load('usuario/resetclave/',{US_SECUENCIAL:codigo,US_MAIL:mail}).attr('title','Resetear la clave').dialog({
                resizable: false, 
                modal: true,
                beforeclose : function() {
                        $("#itemUsr").trigger("reloadGrid");
                        $(this).delay(3000).queue(function() {
                                $(this).fadeOut("slow");
                                $(this).dialog("destroy");
                            });
                },
                buttons: {
                    "Cerrar": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
    }
		}else{
			alert("El usuario seleccionado no puede estar sin CODIGO...");
		}
        }
    });			
	
});
</script>
