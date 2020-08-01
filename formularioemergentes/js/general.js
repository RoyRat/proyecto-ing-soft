function lTrim(sStr){
    while (sStr.charAt(0) == " ")
        sStr = sStr.substr(1, sStr.length - 1);
    return sStr;
}

function rTrim(sStr){
    while (sStr.charAt(sStr.length - 1) == " ")
        sStr = sStr.substr(0, sStr.length - 1);
    return sStr;
}

function allTrim(sStr){
    return rTrim(lTrim(sStr));
}
        
function empty (mixed_var) {
    var key;

    if (mixed_var === "" || mixed_var === 0 || mixed_var === "0" || mixed_var === null || mixed_var === false || typeof mixed_var === 'undefined') {
        return true;
    }

    if (typeof mixed_var == 'object') {
        for (key in mixed_var) {
            return false;
        }
        return true;
    }

    return false;
}


(function($){
    $.fn.extend({
        xImprimir: function(options){
            var $this = jQuery(this); //Convertimos a jQuery 
            this.each(function(){  
                $(options.idButton).button({
                text: options.showText,
                icons: {
                primary: "ui-icon-print"
            }
            }).click(function(){
               
                if(!$().jEmpty(options.selectMultiple)){
                    var ValorSeleccionado = $this.getGridParam("selarrrow"); // Depende de jqgrid
                }else{
                    var ValorSeleccionado = $this.getGridParam("selrow"); // Depende de jqgrid
                }
				
                var NombreDialog = "dialog_"+$().jRand(10,100);
                $this.append("<div id='"+NombreDialog+"' title='"+options.titulo+"'></div>");
                 if($().jEmpty(ValorSeleccionado)) {
                     var NombreDialogError = "dialogSpan_"+$().jRand(10,100);
                     $this.append("<span id='"+NombreDialogError+"'></span>");
                      $('#'+NombreDialog)
                      .html($("#"+NombreDialogError).writeError(options.errorMens))
                      .dialog({
                        modal:true,
                        width:200,
                        position: "center",
                        closeOnEscape: false,
                        beforeclose : function() { 
                             $(this).dialog("destroy");
                             $('#'+NombreDialog).remove(); 
                        },
                        buttons:{
                            "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                    });
                 }else{
                    
                   if(!$().jEmpty(options.hasExtraValues)){
                       var extras = options.extraValues();
                   }else{
                       var extras = null;
                   }
                    
                      $.post(options.url,{ids:ValorSeleccionado,extras:extras}, function(data) {
                      var NombreDialogError = "dialogSpan_"+$().jRand(10,100);
                      $this.append("<span id='"+NombreDialogError+"'></span>");
                      $('#'+NombreDialog)
                      .html(data.mensaje)
                      .dialog({
                        modal:true,
                        width:options.ancho,
                        position: "center",
                        closeOnEscape: false,
                        beforeclose : function() { 
                             $(this).dialog("destroy");
                             $('#'+NombreDialog).remove(); 
                        },
                        buttons:{
                            "Descargar" : function(){                                
                                if(data.url != null){
                                    window.open(data.url); 
                                }
                                
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            },
                            "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                     });
                   },"json");
                 }
             });
          });
        },
        jImprimir: function(options){
            var $this = jQuery(this); //Convertimos a jQuery 
            this.each(function(){  
                $(options.idButton).button({
                text: false,
                icons: {
                primary: "ui-icon-print"
            }
            }).click(function(){
               
                var ValorSeleccionado = $this.getGridParam("selrow"); // Depende de jqgrid
                var NombreDialog = "dialog_"+$().jRand(10,100);
                $this.append("<div id='"+NombreDialog+"' title='"+options.titulo+"'></div>");
                 if(ValorSeleccionado == null) {
                      $('#'+NombreDialog)
                      .html(options.errorMens)
                      .dialog({
                        modal:true,
                        width:200,
                        position: "center",
                        buttons:{
                            "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                    });
                 }else{
                      $.post(options.url,{ids:ValorSeleccionado}, function(data) {
                      $('#'+NombreDialog)
                      .html(options.okMens)
                      .dialog({
                        modal:true,
                        width:options.ancho,
                        position: "center",
                        buttons:{
                            "Descargar" : function(){
                                window.open(data); 
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            },
                            "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                     });
                   });
                 }
             });
          });
        },jConfirmacion: function(options){
            var $this = jQuery(this); //Convertimos a jQuery 
            this.each(function(){
                var NombreDialog = "dialog_"+$().jRand(10,100);
                $this.append("<div id='"+NombreDialog+"' title='"+options.titulo+"'></div>");
                var NombreDialogError = "dialogSpan_"+$().jRand(10,100);
                $this.append("<span id='"+NombreDialogError+"'></span>");
                
                    if(options.tipoMensaje == "error"){
                        $('#'+NombreDialog).html($("#"+NombreDialogError).writeError(options.mensaje));
                    }else if(options.tipoMensaje == "highlight"){
                        $('#'+NombreDialog).html($("#"+NombreDialogError).writeAlert(options.mensaje));
                    }else{
                        $("#"+NombreDialogError).append(options.mensaje);
                    }
                      
                      $('#'+NombreDialog).dialog({
                        modal:true,
                        width:options.ancho,
                        position: options.posicion,
                        closeOnEscape: false,
                        show: "blind",
			hide: "explode",
                        beforeclose : function() {
                             $(this).dialog("destroy");
                             $('#'+NombreDialog).remove(); 
                        },
                        buttons:{
                            "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                        });
          });
        },
    jValidacion:function(options){
      var $this = jQuery(this);
       return this.each(function(){  
         $this.validate({ // depende del plug-in validate
                    errorClass: "ui-state-error",
                    validClass: "ui-state-highlight", 
                    wrapper: "span class='ui-extra-validation ui-widget ui-container'",
                    submitHandler: function() {
                        options.submitAccion();
                    },
                    rules: options.rules
                });  
        });
    },
    jFormNoButton:function(options){
       var $this = jQuery(this);
       return this.each(function(){  
        $(options.idButton).click(function(){
               var ValorSeleccionado = $this.getGridParam("selrow");
               var NombreDialog = "dialog_"+$().jRand(10,100);
               $this.append("<div id='"+NombreDialog+"' title='"+options.titulo+"'></div>");
               if(ValorSeleccionado == null) {
                 $('#'+NombreDialog)
                      .empty()
                      .html(options.errorMens)
                      .dialog({
                        modal:true,
                        width:200,
                        position: options.posicion,
                        buttons:{
                            "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                    });
               }else{    
                   $('#'+NombreDialog).empty().load(options.url,{ids:ValorSeleccionado,IDdialog:'#'+NombreDialog})
                   .dialog({
                        modal:true,
                        width:options.ancho,
                        position: options.posicion,
                        buttons:{
                            "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                    });
               /* Compruebo que exista una acciÃ³n personalizada.
                * Si es asÃ­, la ejecutamos tal como el usuario la enviÃ³.
                *  */
               if(!$().jEmpty(options.acciones)){
                  options.acciones.apply();
                }
               }       
            });
        });
    },
    jMostrar:function(options){
       var $this = jQuery(this);
       return this.each(function(){  
        $(options.idButton).button({
            text: false,
            icons: {
               primary: options.icon
            }
        }).click(function(){
               var ValorSeleccionado = $this.getGridParam("selrow"); // Depende de jqgrid
               console.log(ValorSeleccionado);
               var NombreDialog = "dialog_"+$().jRand(10,100);
               $this.append("<div id='"+NombreDialog+"' title='"+options.titulo+"'></div>");
               if(ValorSeleccionado == null) {
                 $('#'+NombreDialog)
                      .empty()
                      .html(options.errorMens)
                      .dialog({
                        modal:true,
                        width:options.ancho,
                        position: options.posicion,
                        buttons:{
                            "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                    });
               }else{    
                   $('#'+NombreDialog)
                      .empty()
                      .html(options.errorMens)
                      .load(options.url,{ids:ValorSeleccionado})
                      .dialog({
                        modal:true,
                        width:options.ancho,
                        position: options.posicion,
                        buttons:{
                            "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                    });
               /* Compruebo que exista una acciÃ³n personalizada.
                * Si es asÃ­, la ejecutamos tal como el usuario la enviÃ³.
                *  */
               if(!$().jEmpty(options.acciones)){
               		options.acciones.apply();
               	}
               }       
            });
        });
    },
    jPostMultiple: function(options){
            var $this = jQuery(this); //Convertimos a jQuery
            
            this.each(function(){  
                $(options.idButton).button({
                text: options.showTextButton,
                icons: {
                primary: options.icon
            	}
            }).click(function(){
                var ValorSeleccionado = $this.getGridParam("selarrrow"); // Depende de jqgrid       
                
                var NombreDialog = "dialog_"+$().jRand(10,100);
                
                if(!$().jEmpty(options.extraID)){
                	extraID = options.extraID.apply();
                }else{
                	extraID = null;
                }
                $this.append("<div id='"+NombreDialog+"' title='"+options.titulo+"'></div>");
                 if(ValorSeleccionado == null) {
                      $('#'+NombreDialog)
                      .html(options.errorMens)
                      .dialog({
                        modal:true,
                        width:options.ancho,
                        position: "center",
                        buttons:{
                            "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                    });
                  
                 }else{

                      $.post(options.url,{ids:ValorSeleccionado,extra:extraID}, function(data) {
	                if(!$().jEmpty(options.acciones)){
	               			options.acciones.apply();
	               		}
                      $('#'+NombreDialog)
                      .html(data)
                      .dialog({
                        modal:true,
                        width:options.ancho,
                        position: "center",
                        buttons:
													{ "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                          	}
                        	}
                     });
                   });
                 
                 }
             });
         
          });
        },
    jForm:function(options){
       var $this = jQuery(this);
       return this.each(function(){  
        $(options.idButton).button({
            text: options.showText,
            icons: {
               primary: options.icon
            }
        }).click(function(){
               var ValorSeleccionado = $this.getGridParam("selrow"); // Depende de jqgrid
               var NombreDialog = "dialog_"+$().jRand(10,100);
               $this.append("<div id='"+NombreDialog+"' title='"+options.titulo+"'></div>");
               if(ValorSeleccionado == null) {
                 var NombreDialogError = "dialogSpan_"+$().jRand(10,100);
                 $this.append("<span id='"+NombreDialogError+"'></span>");
                 $('#'+NombreDialog)
                      .empty()
                      .html($("#"+NombreDialogError).writeError(options.errorMens))
                      .dialog({
                        modal:true,
                        width:options.ancho,
                        position: options.posicion,
                        closeOnEscape: false,
                        beforeclose : function() { 
                             $(this).dialog("destroy");
                             $('#'+NombreDialog).remove(); 
                        },
                        buttons:{
                            "Cerrar": function() {
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                    });
               }else{    
                   $('#'+NombreDialog)
                      .empty()
                      .load(options.url,{ids:ValorSeleccionado})
                      .dialog({
                        modal:true,
                        width:options.ancho,
                        position: options.posicion,
                        closeOnEscape: false,
                        beforeclose : function() { 
                            if(!$().jEmpty(options.accionesSuccess)){
                                            options.accionesSuccess.apply();
                                        }
                             $(this).dialog("destroy");
                             $('#'+NombreDialog).remove(); 
                        },
                        buttons:{
                            "Continuar":function(){
                               $.post(options.formUrl, $(options.idForm).serialize(), function(msg){
                                   $('#'+NombreDialog).html(msg).delay(5000).queue(function() {
                                       if(!$().jEmpty(options.accionesSuccess)){
                                            options.accionesSuccess.apply();
                                        }
                                        $(this).remove();
                                    });
                               }, "html");
                            },
                            "Cerrar": function() {
                                if(!$().jEmpty(options.accionesSuccess)){
                                            options.accionesSuccess.apply();
                                        }
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                    });
               /* Compruebo que exista una accion personalizada.
                * Si es asi, la ejecutamos tal como el usuario la envia.
                *  */
               if(!$().jEmpty(options.acciones)){
                  options.acciones.apply();
                }
               }       
            });
        });
    },
    jRand:function(from,to){
        return Math.floor(Math.random() * (to - from + 1) + from);
    },
    jEmpty:function empty(mixed_var) {
	    var key;
	    if (mixed_var === "" || mixed_var === 0 || mixed_var === "0" || mixed_var === null || mixed_var === false || typeof mixed_var === 'undefined') {
	        return true;
	    }
	    if (typeof mixed_var == 'object') {
	        for (key in mixed_var) {
	            return false;
	        }
	        return true;
	    }
	
	    return false;
		},
    jXEmpty:function empty(mixed_var) {
	    var key;
	    if (mixed_var === "" || mixed_var === null || mixed_var === false || typeof mixed_var === 'undefined') {
	        return true;
	    }
	    if (typeof mixed_var == 'object') {
	        for (key in mixed_var) {
	            return false;
	        }
	        return true;
	    }
	
	    return false;
		},jAppendButtonJqgrid:function(options){
      var $this = jQuery(this);
      $this.append("<button id='"+options.id+"' >"+options.texto+"</button>");
      return "#"+options.id;
    },jRecargar:function(options){
      var $this = jQuery(this);
       return this.each(function(){  
        $(options.idButton).button({
            text: false,
            icons: {
               primary: options.icon
                }
            }).click(function(){
                $(options.id).trigger("reloadGrid");
                });
        });
    },
    jMostrarNoGrid:function(options){
        var $this = jQuery(this);
       return this.each(function(){  
        $(options.idButton).button({
            text: options.showText,
            icons: {
               primary: options.icon
            }
        }).click(function(){
            if(options.valuesIsFunction == true){
                ValorSeleccionado = options.values();
            }else{
                var ValorSeleccionado = options.values;
            }
               var NombreDialog = "dialog_"+$().jRand(10,100);
               $this.append("<div id='"+NombreDialog+"' title='"+options.titulo+"'></div>");
               if(ValorSeleccionado == null) {
                
                 var NombreDialogError = "dialogSpan_"+$().jRand(10,100);
                 $this.append("<span id='"+NombreDialogError+"'></span>");
                 $('#'+NombreDialog)
                      .empty()
                      .html($("#"+NombreDialogError).writeError(options.errorMens))
                      .dialog({
                        modal:true,
                        width:200,
                        open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
                        position: "top",
                        closeOnEscape: false,
                        beforeclose : function() { 
                            if(!$().jEmpty(options.alCerrar)){
                              options.alCerrar.apply();
                            }
                             $(this).dialog("destroy");
                             $('#'+NombreDialog).remove(); 
                        },
                        buttons:{
                            "Cerrar": function() {
                                if(!$().jEmpty(options.alCerrar)){
                                  options.alCerrar.apply();
                                }
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                    });
                    
               }else{ 
                   
                   $.ajax({
                        dataType: options.respuestaTipo,
                        type: "POST",
                        data:ValorSeleccionado,
                        success: function(data) {
                            if(options.respuestaTipo == "json"){
                              $('#'+NombreDialog).writeAlert(data.mensaje);
                              if(!$().jEmpty(options.accionesSuccess)){
                                options.accionesSuccess(data);
                              }
                            }else if(options.respuestaTipo == "html"){
                              
                              $('#'+NombreDialog).append(data);
                              if(!$().jEmpty(options.accionesSuccess)){
                                options.accionesSuccess();
      
                              }

                            }else{
                              alert("Error: no se definio el tipo de respuesta.");
                            }

                        },
                        url: options.url
                    });
                   $('#'+NombreDialog)
                      .empty()
                      .dialog({
                        modal:true,
                        width:options.ancho,
                        height:options.alto,
                        position: options.posicion,
                        closeOnEscape: false,
                        open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
                        beforeclose : function() { 
                            if(!$().jEmpty(options.alCerrar)){
                              options.alCerrar.apply();
                            }
                             $(this).dialog("destroy");
                             $('#'+NombreDialog).remove();
                             
                        },
                        buttons:{
                            "Cerrar": function() {
                                if(!$().jEmpty(options.alCerrar)){
                                  options.alCerrar.apply();
                                }
                                $(this).dialog("destroy");
                                $('#'+NombreDialog).remove();
                            }
                        }
                    });
               /* Compruebo que exista una accion personalizada.
                * Si es asi, la ejecutamos tal como el usuario la envio.
                *  */
               if(!$().jEmpty(options.acciones)){
                  options.acciones.apply();
                }
               }       
               var btns = {};
               if(!$().jEmpty(options.botonExtra)){
                       btns[options.botonExtraText] = function(){ 
                              dialogId = '#'+NombreDialog;
                              options.botonExtraFunction(dialogId);  
                        };
               }
               if(!$().jEmpty(options.formAction)){
                   if($().jEmpty(options.botonSubmit)){
                       btns["Grabar"] = function(){ 
                            dialogId = '#'+NombreDialog;
                            options.formAction(dialogId); 
                        };
                   }else{
                       btns[options.botonSubmit] = function(){ 
                            dialogId = '#'+NombreDialog;
                            options.formAction(dialogId); 
                        };
                   }
                    btns["Cerrar"] = function(){ 
                            $(this).dialog("destroy");
                            $('#'+NombreDialog).remove();  
                    };
                   
                $('#'+NombreDialog).dialog({
                    buttons: btns 
                });
                }else{
                    console.log("No se ejecuto ninguna tarea...");
                }
            });
        });
    }
    })
})(jQuery);
(function($){
     $.fn.writeError = function(message){
        return this.each(function(){
           var $this = $(this);

           var errorHtml = "<div class=\"ui-widget\">";
           errorHtml+= "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">";
           errorHtml+= "<p>";
           errorHtml+= "<span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin-right: .3em;\"></span>";
           errorHtml+= message;
           errorHtml+= "</p>";
           errorHtml+= "</div>";
           errorHtml+= "</div>";

           $this.html(errorHtml);
        });
     }
})(jQuery);

(function($){
     $.fn.writeHighlight = function(message){
        return this.each(function(){
           var $this = $(this);

           var alertHtml = "<div class=\"ui-widget\">";
           alertHtml+= "<div class=\"ui-state-highlight ui-corner-all\" style=\"padding: 0 .7em;\">";
           alertHtml+= "<p>";
           alertHtml+= "<span class=\"ui-icon ui-icon-info\" style=\"float:left; margin-right: .3em;\"></span>";
           alertHtml+= message;
           alertHtml+= "</p>";
           alertHtml+= "</div>";
           alertHtml+= "</div>";

           $this.html(alertHtml); 
        });
     } 
})(jQuery);

(function(jq){
  var editar ={			    
	recreateForm : true,
	closeAfterAdd: true,
	closeAfterEdit: true,
	zIndex: 10000
      };
      var eliminar = {
	zIndex: 10000
      }
      jq.extend(true, jq.jgrid.edit, editar);
      jq.extend(true, jq.jgrid.del, eliminar);
    })(jQuery);
	
    $(function(){
      jQuery(document).ajaxStart(function(){$(".container_12:first").mask("Cargando...");})
      .ajaxStop(function(){$(".container_12:first").unmask();});
});
(function($){
     $.fn.writeError = function(message){
        return this.each(function(){
           var $this = $(this);
           var errorHtml = "<div class=\"ui-widget\">";
           errorHtml+= "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">";
           errorHtml+= "<span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin-right: .3em;\"></span>";
           errorHtml+= message;
           errorHtml+= "</div>";
           errorHtml+= "</div><br />";
           $this.html(errorHtml);
        });
     }
})(jQuery);

(function($){
     $.fn.writeAlert = function(message){
        return this.each(function(){
           var $this = $(this);
           var alertHtml = "<div class=\"ui-widget\">";
           alertHtml+= "<div class=\"ui-state-highlight ui-corner-all\" style=\"padding: 0 .7em;\">";
           alertHtml+= "<span class=\"ui-icon ui-icon-info\" style=\"float:left; margin-right: .3em;\"></span>";
           alertHtml+= message;
           alertHtml+= "</div>";
           alertHtml+= "</div><br />";

           $this.html(alertHtml);
        });
     }


})(jQuery);