<?php $this->load->view('general/cabecera');
?>
<link rel="stylesheet" type="text/css" href="css/menu.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/css.css" media="screen" />
<body>
	<div class="container_12">
		
		<div class="grid_8 alpha">
			<form id="principalImagen">
				<?php //$varuia ='<input type="text" name="caja" value="">'; ?>
			</form>
			<h1 title="Sistema Administración de Aplicaciones"  style=" text-align: center; font-size:4em; font-weight:bold; color: #FFFFFF !important; margin-left: -100px; margin-top:50px;">SISTEMA ANÁLISIS EMERGENTE</h1>
		</div>
		
		<div class="grid_4 omega" style="Margin-top:15px; padding-top:5px ">
			<br>
			<br>
			<span style="font-size:1.5em; color:#FFFFFF;"><b>USUARIO: </b>&nbsp;<?php echo html_entity_decode($this->session->userdata('US_NOMBRES'));?></span>
			<br />
			<br />
			<span style="font-size:1.5em; color:#FFFFFF;"><b>ROL: </b>&nbsp;<?php echo html_entity_decode(($this->session->userdata('US_NOMBRE_PERFIL')));?></span>
			<br />
			<br />
			<span style="font-size:1.5em; color:#FFFFFF;"><b>FECHA ACTUAL: </b>&nbsp;<?php echo @date("Y-m-d");?> <span id="time"><?php echo @date("H:i:s");?></span></span>
		</div>
        
		<div id="c_menu_opciones"  class="grid_12">
			
		</div>
		<div id="contenido_general" class="grid_12 omega">
			<h2 style="z-index:-100;position:absolute;border: 0px solid #CCC; margin: 5em 0em 0em 0em; width:auto; height:auto; text-shadow: 1px 2px #999;">
				<p align="center">
					<img src="imagenes/cliente.png" title="Sistema Administración de Aplicaciones" class="img-responsive" width="650" height="600" />
					<font align="center" color="#000000">
					</font>
				</p>
			</h2>
		</div>
	</div>
    <div id="dialog-form" title=""></div>	
	
	<div id="barra">
	</div>
	
	<div title="Menú del Sistema" id="c_menu_opciones" style="z-index:0;position:absolute;">
		
		<div id='cssmenu'>
			<ul> 
				<?php if(($this->lib_usuarios->getAccesoSeccion($this->session->userdata('US_CODIGO'),'ADMS')==1)){?>
					<li><a title="Módulo Administración de Aplicación" href='#'><span>Administración de Aplicación</span></a>
						<ul>													
							<li><a id="e_aplicacion" name="sistema/index" title="Administración de Aplicación" class="cabecera-links" href="#">Aplicación</a></li>			
							<li><a id="e_usuarios" name="usuario/index" title="Administración de Usuarios" class="cabecera-links" href="#">Usuarios</a></li>
							<li><a id="e_localizacion" name="lugar/index" title="Administración de Lugares" class="cabecera-links" href="#">Localización</a></li>
						</ul>
					</li>
				<?php  } ?>
					<li><a title="Módulo Emisión de Reportes" href='#'><span>Reporteria</span></a>
						<ul>													
							<li><a id="e_salud" name="reporte/salud" title="Reporte Salud" class="cabecera-links" href="#">Salud</a></li>
							<li><a id="e_educacion" name="reporte/educacion" title="Reporte Educación" class="cabecera-links" href="#">Educación</a></li>
							<li><a id="e_economia" name="reporte/economia" title="Reporte Economía" class="cabecera-links" href="#">Economía</a></li>
							<li><a id="e_seguridad" name="reporte/seguridad" title="Reporte Seguridad" class="cabecera-links" href="#">Seguridad</a></li>
							//<li><a id="e_sector" name="reporte/sector" title="Reporte Sectores" class="cabecera-links" href="#">Sectores</a></li>
						</ul>
					</li>
				<li>
					<a id="e_salir" style="color:#FF0000; font-weight: bold;" title="Salida del Sistema(Cierre de Sesión)" class="titular" href="general/inicio/salir"><span>Salir</span></a>
				</li>
			</ul>
		</div>
	</div>
</body>
<script>
	$('#mostrar-nav').on('click',function(){
		$('nav').toggleClass('mostrar');
	})
	
	$(function(){
		
		$("#menu_opciones").wijmenu({
			trigger: ".wijmo-wijmenu-item",
			triggerEvent: "click"
		});
		
		$(".cabecera-links").each(function(){
			$('#'+$(this).attr("id")).click(function(){
				$("#contenido_general").load($(this).attr("name"),{});
			});
		});
		
		
		var interval_verificar_sesion = setInterval(
		function(){
			$.ajax({
				type: 'GET',
				url: "<?php echo site_url("general/verificar_sesion")?>",
				success: function(r){
					if(r.estaActivo == 1){
						}else{
						alert(r.mensaje);
						document.location = "<?php echo site_url('general/inicio/salir')?>";
					}
				},
				beforeSend: function(jqXHR, settings){
					$(".container_12:first").unmask();
				},
				error: function(jqXHR, textStatus, errorThrown){
					var pregunta = confirm("Se perdió el contacto con el servidor. \n Desea esperar?...");
					if(!pregunta){
						document.location = "<?php echo site_url('general/inicio/salir');?>";
					}
				},
				dataType: "json"
			});
		}, 
		4500000
		);
	});
	
	setInterval(function(){
		var tiempo = new Date();
		var hora = tiempo.getHours();
		var minuto = tiempo.getMinutes();
		var segundo = tiempo.getSeconds();
		if(segundo.toString().length == 1 ){
			segundo='0'+segundo;
		}
		$('#time').html(hora+':'+minuto+':'+segundo);	
	}, 1000 );
	
	var ISTCRE = {
		intervalo: null,
		crearWijdialog: function(elemento, opciones){
			this.intervalo = self.setInterval(function(){
				ISTCRE.verificarCrearWijdialog(elemento, opciones)
			}, 130);
		},
		verificarCrearWijdialog: function(elm, opciones){
			var elemento = $(elm);
			if(elemento.size() > 0){ 
				opciones.close = function(e, ui){
					$("*", $(this)).remove();
					$(this).dialog("destroy").remove();	  
					//$(this).remove();
				};
				opciones.zIndex = 1;
				opciones.captionButtons = {refresh:{visible: false}, pin:{visible: false}, maximize:{visible: false}};
				elemento.wijdialog(opciones);      
				window.clearInterval(this.intervalo);
			}
		}
	}
</script>
</html>						
