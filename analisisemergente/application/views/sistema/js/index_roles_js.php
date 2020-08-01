<script type="text/javascript">
$(function () {
var sistema='<?php echo $sistema;?>';
var sistemas="<?php echo $sistemas; ?>";

$("#roles").jqGrid({
            url:"sistema/getListadoRoles",
            datatype: "json",
            colNames:["Secuencial","Descripción","Sistema", "Estado"],
              postData:{sistema:sistema},
            colModel:[
                {name:'USR_SECUENCIAL',index:'USR_SECUENCIAL', width:20, fixed:true, sortable:false, hidden:true},
                {name:'USR_DESCRIPCION',index:'USR_DESCRIPCION', width:200},                
                {name:'USR_SEC_APLICACION',index:'USR_SEC_APLICACION',hidden:true},
				{name:'USR_ESTADO',index:'USR_ESTADO',searchable:false, width:40,align:"center", edittype:'select', formatter:'select', editoptions:{value:"0:<span class='ui-icon ui-icon-circle-check ui-icon-extra'>No</span>;1:<span class='ui-icon ui-icon-circle-close ui-icon-extra'>Si</span>"}}
            ],
            rowNum:20,
            rowList:[10,20,40,60,120,240,480,960],
            pager: '#proles',
            sortname: 'USR_DESCRIPCION',
            viewrecords: true,
            height:400,
            width: 500,
            sortorder: "asc",
            mtype:"POST",
            caption: "Perfiles", 
            toolbar: [true,"top"],
            subGrid: true,
              subGridRowExpanded: function(subgrid_id, row_id) {
                var subgrid_table_id,  pager_id;
                var codigo= $("#rol").getCell(row_id,'USR_DESCRIPCION');
                subgrid_table_id = subgrid_id+"_t";
                pager_id = "p_"+subgrid_table_id;
               $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
               jQuery("#"+subgrid_table_id).jqGrid({
                   url:"sistema/getdirectivasrol/"+row_id,
                   datatype: "json",
                   mtype:"POST",
                   caption: "Directivas ", 
                   colNames:['Sec','Descripción','Alias','Estado'],
                      colModel:[
                        {name:'USP_SECUENCIAL',index:'USD_SECUENCIAL',  hidden:true},
                        {name:'USD_DESCRIPCION',index:'USD_DESCRIPCION',   width:200},
                        {name:'USD_ALIAS',index:'USD_ALIAS',  width:100},
                        {name:'USP_ESTADO',index:'USD_ESTADO', width:20,searchable:false, width:30,align:"center", edittype:'select', formatter:'select', editoptions:{value:"0:<span class='ui-icon ui-icon-circle-check ui-icon-extra'>Activo</span>;1:<span class='ui-icon ui-icon-circle-close ui-icon-extra'>Pasivo</span>"}},
                    ],
                  rowNum:20,
                  sortname: 'USP_SECUENCIAL',
                  sortorder: "asc",
                  width:400,
                  shrinkToFit:false,
                  height: '100%',
                  toolbar: [true,"top"]
               });
                 jQuery("#t_"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false});                 
                  var b1="agr"+row_id;
                  var b2="del"+row_id;
                  var b4="act"+row_id;
				  if(sistemas==1){
                $("#"+subgrid_table_id).append("<button title='Agregar Directiva' id='"+b1+"'>Agr.</button>")
                  .append("<button title='Bloquear Directiva' id='"+b2+"'>Blq.</button>")
                  .append("<button title='Activar Directiva' id='"+b4+"'>Act.</button>");
				  }
               $("#"+b1).jMostrarNoGrid({
                        id:"#"+subgrid_table_id,
                        idButton:"#"+b1,
                        errorMens:"No se puede mostrar el formulario, contacte al administrador.",
                        url: "sistema/MostrarFormluarioDir/0",
                        titulo: "Directivas Perfil "+codigo,
                        ancho:446,
                        posicion: "top",
                        showText:true,
                        icon:"ui-icon-plusthick",
                        respuestaTipo:"html",
                        valuesIsFunction: true,
                        formAction:function(dialogId){
                          $("#usu_dirFrm").jValidacion({
                             submitAccion: function(){             
                                         var datos=$("#usu_dirFrm").serialize();
                                         $.post("sistema/GrbFrmDir", datos, function (r){
                                                  $("#"+subgrid_table_id).trigger("reloadGrid");
                                          }, "json");
                                   },
                                   rules:{								
                                          USR_SECUENCIAL : { required: true}
                                   }
                                }); 
                             $("#usu_dirFrm").submit();	
                        },
                        values:function (){	
                            return {USR_SECUENCIAL:row_id,sistema:sistema};
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
                               if (confirm ('Esta seguro de inactivar esta directiva?')) {
                                  $.post(
                                          "sistema/blqrDir",
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
                            alert ("Seleccione una aplicacion de este usuario para inactivar");
                       }else {
                               if (confirm ('Esta seguro de inactivar esta directiva?')) {
                                  $.post(
                                          "sistema/ActvrDir",
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
              
            },
               subGridRowColapsed: function(subgrid_id, row_id) {
                 var subgrid_table_id; subgrid_table_id = subgrid_id+"_t";
                 jQuery("#"+subgrid_table_id).remove();
              }
           
        });

        
        $("#t_roles").jAppendButtonJqgrid({
     texto:"Nuevo Perfil",
     id:"AddRoles"
    });
    
    $("#t_roles").jAppendButtonJqgrid({
     texto:"Modificar Perfil",
     id:"modPerfiles"
    });
    
    $("#t_roles").jAppendButtonJqgrid({
     texto:"Activar Perfil",
     id:"ActivarPerfiles"
    });
	
    $("#t_roles").jAppendButtonJqgrid({
     texto:"Recargar Listado",
     id:"RefreshRoles"
    });
    
    $("#t_roles").jAppendButtonJqgrid({
     texto:"Bloquear Perfil",
     id:"blockPerfiles"
    });
    
    $("#t_roles").jAppendButtonJqgrid({
     texto:"Eliminar Perfil",
     id:"delPerfiles"
    });
    
    $("#roles").jRecargar({
     id:"#roles",
     idButton:"#RefreshRoles",
     icon:"ui-icon-refresh"
    });
    
  
  $("#roles").jMostrarNoGrid({
        id:"#roles",
        idButton:"#AddRoles",
        errorMens:"No se puede mostrar el formulario.",
        url: "sistema/MostrarFormluarioRoles/0",
        titulo: "Agregar un perfil de usuarios",
        ancho: 450,
        posicion: "center",
        showText:false,
        icon:"ui-icon-circle-plus",
        respuestaTipo:"html",
        formAction:function(dialogId){
            $("#usu_rolFrm").jValidacion({
                submitAccion: function(){
                    var data = $("#usu_rolFrm").serialize();
                    $.post("sistema/GrabarFormRoles", data,
                        function(data){
                            $("#roles").trigger("reloadGrid");
                            $(dialogId).html(data.mensaje);
                            $(dialogId).dialog({
                            buttons: {
                                "Cerrar": function(){
                                    
                                    $(this).dialog("destroy");
                                    $(dialogId).remove(); 
                                    }
                                }
                            });
                            
                        }, "json");
                },
                rules:{
                    USR_DESCRIPCION:"required"
                }
            });  
            $("#usu_rolFrm").submit();
        },
        values:{
            ids:null,sistema:sistema
        }
    });
    
    $("#roles").jMostrarNoGrid({
        id:"#roles",
        idButton:"#modPerfiles",
        errorMens:"Debe seleccionar un perfil para modificarlo.",
        url: "sistema/MostrarFormluarioRoles/1/",
        titulo: "Modificar un perfil de usuarios",
        ancho: 550,
        posicion: "center",
        showText:false,
        icon:"ui-icon-pencil",
        respuestaTipo:"html",
        valuesIsFunction: true,
        formAction:function(dialogId){
            $("#usu_rolFrm").jValidacion({
                submitAccion: function(){
                    var data = $("#usu_rolFrm").serialize();
                    $.post("sistema/GrabarmodFormRoles", data,
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
                            $("#roles").trigger("reloadGrid");
                        }, "json");
                },
                rules:{
                    USR_DESCRIPCION:"required"
                }
            });  
            $("#usu_rolFrm").submit();
        },
        values:function(){
            var ids = $("#roles").getGridParam("selrow");
            if($().jEmpty(ids)){
                return null;
            }else{
                return {USR_SECUENCIAL:ids,sistema:sistema};
            }
        }
    });
    
    $("#ActivarPerfiles").button({
        text: false,
        icons:{
            primary: "ui-icon-check"
        }
    }).click(function(){
        var NombreDialog = "dialog_"+$().jRand(10,100);
        $("body").append("<div id='"+NombreDialog+"'></div>");
        var ids=$("#roles").getGridParam("selrow");

        if(ids == null) {
            $( "#"+NombreDialog ).load("sistema/errorSeleccion").attr('title','Error').dialog({
                resizable: false, 
                modal: true,
                beforeclose : function() {
                        $("#roles").trigger("reloadGrid");
                           $(this).dialog("destroy");

                },
                buttons: {
                    "Cerrar": function() {
                        $( this ).dialog( "close" );
                         $(this).dialog("destroy");
                    }
                }
            });
        }else {
         $( "#"+NombreDialog ).load('sistema/ActivarPerfil/',{USR_SECUENCIAL:ids}).attr('title','Activar un perfil').dialog({
                resizable: false, 
                modal: true,
                beforeclose : function() {
                        $("#roles").trigger("reloadGrid");
                        $(this).dialog("destroy");
                },
                buttons: {
                    "Cerrar": function() {
                        $("#roles").trigger("reloadGrid");
                        $( this ).dialog( "close" );
                    }
                }
            });

        }
    });
    
    $("#roles").jMostrarNoGrid({
        id:"#roles",
        idButton:"#delPerfiles",
        errorMens:"Debe seleccionar un perfil para eliminarlo.",
        url: "sistema/MostrarEliminacionRoles/",
        titulo: "Eliminar un perfil de usuarios",
        ancho: 550,
        posicion: "center",
        showText:false,
        icon:"ui-icon-trash",
        respuestaTipo:"html",
        botonSubmit: "Continuar",
        valuesIsFunction: true,
        formAction:function(dialogId){
            var data = $("#usu_rolFrm").serialize();
            $.post("sistema/EliminarRoles", data,
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
                    $("#roles").trigger("reloadGrid");
                }, "json");
        },
        values:function(){
            var ids = $("#roles").getGridParam("selrow");
            if($().jEmpty(ids)){
                return null;
            }else{
                return {USR_SECUENCIAL:ids};
            }
        }
    });
    
    $("#blockPerfiles").button({
        text: false,
        icons:{
            primary: "ui-icon-close"
        }
    }).click(function(){
        var NombreDialog = "dialog_"+$().jRand(10,100);
        $("body").append("<div id='"+NombreDialog+"'></div>");
        var ids=$("#roles").getGridParam("selrow");

        if(ids == null) {
            $( "#"+NombreDialog ).load("sistema/errorSeleccion").attr('title','Error').dialog({
                resizable: false, 
                modal: true,
                beforeclose : function() {
               $("#roles").trigger("reloadGrid");
                         $(this).dialog("destroy");
                },
                buttons: {
                    "Cerrar": function() {
                        $( this ).dialog( "close" );
                        $(this).dialog("destroy");
                    }
                }
            });
        }else {

            $( "#"+NombreDialog ).load('sistema/bloquearPerfil/',{USR_SECUENCIAL:ids}).attr('title','Bloquear un perfil').dialog({
                resizable: false, 
                modal: true,
                beforeclose : function() {
                        $("#roles").trigger("reloadGrid");
                        $(this).dialog("destroy");
                },
                buttons: {
                    "Cerrar": function() {
                        $("#roles").trigger("reloadGrid");
                        $( this ).dialog( "close" );
                    }
                }
            });
        }
        
    });
  
});
</script>