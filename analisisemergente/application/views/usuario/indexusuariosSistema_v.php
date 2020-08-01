<div id="d_usuarios"  title="Usuarios">
<table id="usersistema" class="scroll" cellpadding="0" cellspacing="0"></table>
 <div id="pusersistema" class="scroll" style="text-align:center;"></div>
</div> 
<script>
$(function() { 
    var sistema='<?php echo $sistema;?>';

$("#usersistema").jqGrid({
            url:"usuario/getUsuariosSistema",
            datatype: "json",
            colNames:['Sec.','CI','Codigo','Nombre',"Activo","Perfil","Localidad",'Mail'],
            postData:{sistema:sistema},
            colModel:[
                {name:'ACC_SECUENCIAL',index:'ACC_SECUENCIAL', width:70},
                {name:'ACC_PERFIL',index:'ACC_PERFIL', width:200},
				{name:'US_CEDULA',index:'US_CEDULA', width:70},
                {name:'US_CODIGO',index:'US_CODIGO', width:100},
                {name:'US_NOMBRES',index:'US_NOMBRES', width:200},
				{name:'US_MAIL',index:'US_MAIL',searchable:false, width:180, align:"center"},                
				{name:'ACC_ESTADO',index:'ACC_ESTADO',searchable:false, width:30,align:"center", edittype:'select', formatter:'select', editoptions:{value:"0:<span class='ui-icon ui-icon-circle-check ui-icon-extra'>Activo</span>;1:<span class='ui-icon ui-icon-circle-close ui-icon-extra'>Pasivo</span>"}}                
            ],
            rowNum:1000,
            rowList:[100,200,500,1000,2000],
            pager: '#pusersistema',
            sortname: 'US_NOMBRES',
            viewrecords: true,
            height:380,
            width: 650,
            sortorder: "asc",
            mtype:"POST",
            caption: "sistemas",
            toolbar: [true,"top"],
            shrinkToFit:false,
   });
   
   $("#usersistema").jqGrid('navGrid','#psuer',{del:false,add:false,edit:false,refresh:true, search: false},{},{},{},{multipleSearch:true,sopt:['cn','eq']});
   $("#usersistema").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : true});
   
 

$("#t_usersistema").jAppendButtonJqgrid({
     texto:"Recargar Listado",
     id:"Refreshusersistema"
    });
    

    
    $("#t_usersistema").jAppendButtonJqgrid({
     texto:"Bloquear acceso",
     id:"blockusersistema"
    });

$("#t_usersistema").jAppendButtonJqgrid({
     texto:"Activar acceso",
     id:"Activarusersistema"
    });

    
    $("#usersistema").jRecargar({
     id:"#usersistema",
     idButton:"#Refreshusersistema",
     icon:"ui-icon-refresh"
    });
    
    
    
   $("#blockusersistema").button({
                       text: true,
                       icons: {
                           primary: "ui-icon-closethick"
                   }
                   }).click(function(evento){
                       var ids=$("#usersistema").getGridParam("selrow");
                        if(ids == null) {
                            alert ("Seleccione una aplicacion de este usuario para inactivar");
                       }else {
                               if (confirm ('Esta seguro de inactivar esta apliacacion?')) {
                                  $.post(
                                          "usuario/delappuser",
                                          {sec:ids},
                                          function(r){
                                              $("#usersistema").trigger("reloadGrid");
                                              if (r.cod==0){
                                                  alert(r.mensaje);
                                              }
                                              
                                          },"json");
                               }
                       }
                    });
                    
                    $("#Activarusersistema").button({
                       text: true,
                       icons: {
                           primary: "ui-icon-check"
                   }
                   }).click(function(evento){
                       var ids=$("#usersistema").getGridParam("selrow");
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
                                              $("#usersistema").trigger("reloadGrid");
                                          },"json");
                               }
                       }
                    });
   
    
    
});
</script>