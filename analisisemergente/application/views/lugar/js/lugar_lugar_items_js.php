<script type="text/javascript">
$(function () {
	
 $("#jq_lugarItems").jqGrid({
            treeGrid: true,
            treeGridModel: 'adjacency',
            ExpandColumn : 'LOC_DESCRIPCION',
            url:"lugar/getLugarItems",
            datatype: "json",
            colNames:["Secuencial","Descripción","Predecesor"],
            colModel:[
                {name:'LOC_SECUENCIAL',index:'LOC_SECUENCIAL',hidden:true,key: true, width:100},
                {name:'LOC_DESCRIPCION',index:'LOC_DESCRIPCION', width:300, align:"center"},
                {name:'LOC_PREDECESOR',index:'LOC_PREDECESOR', align:"left", width:150,hidden:true}
            ],
            rowNum:10,
            rowList:[5,10,25,50,100,200],
            sortname:'LOC_SECUENCIAL',
            viewrecords: true,
            height:400,
			width:650,
            sortorder:'ASC',
            mtype:'POST',
            altRows: true,
            pager:'#jq_p_lugarItems',
            toolbar:[true,"top"]
	});
	
	 $("#jq_lugarItems").jqGrid('navGrid','#jq_p_lugarItems',{del:false,add:false,edit:false,refresh:true, search: false},{},{},{},{multipleSearch:true,sopt:['cn','eq']});
	 $("#jq_lugarItems").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false});
         
	 $("#t_jq_lugarItems").append("<button title='Nuevo Lugar' id='agr_lugarItems'>Nuevo</button>");
	 $("#t_jq_lugarItems").append("<button title='Editar Lugar' id='mod_lugarItems'>Editar</button>");
	 $("#t_jq_lugarItems").append("<button title='Eliminar Lugar' id='del_lugarItems'>Eliminar</button>");
	 $("#t_jq_lugarItems").append("<button title='Recargar Lugar' id='rsh_lugarItems'>Refresh</button>");
     	
		//Agregar Nuevo Registro
		 $("#agr_lugarItems").jMostrarNoGrid({
	        id:"#t_jq_lugarItems",
	        idButton:"#agr_lugarItems",
	        errorMens:"No se pudo mostrar el formulario, debe seleccionar una lista.AGREGAR",
	        url: "lugar/mostfrmLugarItems/",
	        titulo: "Agregar una Lugar",
            ancho: 450,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-plusthick",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
	        formAction:function(dialogId){
	            $("#frmLugar").jValidacion({
	                submitAccion: function(){
	                    var data = $("#frmLugar").serialize();						
	                    $.post("lugar/grbLugarItem", data,
	                        function(data){
	                            $("#mensaje").html(data.mensaje);
								$("#LOC_DESCRIPCION").val("");
	                            $("#jq_lugarItems").trigger("reloadGrid");
	                        }, "json");
	                },
	                rules:{
	                	LOC_DESCRIPCION: {required: true}
	                }
	            });  
	            $("#frmLugar").submit();
	        },values:function (){
				var STR_LOC_SECUENCIAL = $("#jq_lugarItems").getGridParam("selrow");
	            if ($().jEmpty(STR_LOC_SECUENCIAL)){
	                return null;
	            }else{
	                return {LOC_SECUENCIAL:STR_LOC_SECUENCIAL,ADM:1};
	            }
	        }
	    });
            
		//Modificar Registro		
           $("#mod_lugarItems").jMostrarNoGrid({
	        id:"#jq_lugarItems",
	        idButton:"#mod_lugarItems",
	        errorMens:"No se pudo mostrar el formulario, debe seleccionar un item del listado.",
	        url: "lugar/mostfrmLugarItems/",
	        titulo: "Modificar",
	        ancho:450,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-pencil",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
	        formAction:function(dialogId){
	            $("#frmLugar").jValidacion({
	                submitAccion: function(){
	                    var data = $("#frmLugar").serialize();
	                    $.post("lugar/grbLugarItem", data,
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
	                            $("#jq_lugarItems").trigger("reloadGrid");
	                        }, "json");
	                },
	                rules:{
	                	LOC_DESCRIPCION: {required: true}
	                }
	            });  
	            $("#frmLugar").submit();
	        },values:function (){
	            var STR_LOC_SECUENCIAL = $("#jq_lugarItems").getGridParam("selrow");
	            if ($().jEmpty(STR_LOC_SECUENCIAL)){
	                return null;
	            }else{
	                return {LOC_SECUENCIAL:STR_LOC_SECUENCIAL,ADM:2};
	            }
	        }
	    });
            
			//Eliminar Registro			
            $("#del_lugarItems").jMostrarNoGrid({
	        id:"#jq_lugarItems",
	        idButton:"#del_lugarItems",
	        errorMens:"No se pudo mostrar el formulario, debe seleccionar un item del listado.",
	        url: "lugar/mostfrmLugarItems/",
	        titulo: "Eliminar",
	        ancho:450,
	        posicion: "top",
	        showText:true,
	        icon:"ui-icon-closethick",
	        respuestaTipo:"html",
	        valuesIsFunction: true,
	        formAction:function(dialogId){
	            $("#frmLugar").jValidacion({
	                submitAccion: function(){
	                    var data = $("#frmLugar").serialize();
	                    $.post("lugar/grbLugarItem", data,
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
	                            $("#jq_lugarItems").trigger("reloadGrid");
	                        }, "json");
	                },
	                rules:{
	                	LOC_SECUENCIAL: {required: true}
	                }
	            });  
	            $("#frmLugar").submit();
	        },values:function (){
	            var STR_LOC_SECUENCIAL = $("#jq_lugarItems").getGridParam("selrow");
	            if ($().jEmpty(STR_LOC_SECUENCIAL)){
	                return null;
	            }else{
	                return {LOC_SECUENCIAL:STR_LOC_SECUENCIAL,ADM:3};
	            }
	        }
	    });
		
		//Actualiza Registros
            $("#jq_lugarItems").jRecargar({
                id:"#jq_lugarItems",
                showText:true,
                idButton:"#rsh_lugarItems",
                icon:"ui-icon-refresh"
			});            
			//Actualiza Registros
            $("#jq_lugarItems").jRecargar({
                id:"#jq_lugarItems",
                showText:true,
                idButton:"#rsh_lugarItems",
                icon:"ui-icon-refresh"
			});
});
</script>