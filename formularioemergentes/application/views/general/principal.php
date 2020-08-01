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
			
			<!--<img src="<?php				
			?>" alt="FACTURACION" width="140" height="50" style="margin-top:10px; margin-left: -305px; margin-right: 25px; float:left;" />-->
			<a href="https://www.cruzrojainstituto.edu.ec/"><img src="imagenes/istcre1.png" title="Instituto Superior Tecnológico Cruz Roja Ecuatoriana" alt="ISTCRE" width="280" height="50" style="border: 0px solid #CCC;margin-top:10px; margin-left: 0px; margin-right: 25px; float:right;" /></a>
			<h1 title="Sistema de Inventarios"  style=" text-align: center; font-size:3.5em; font-weight:bold; color: #dfdfdf !important; margin-left: -100px; margin-top:50px; text-shadow: 0 10px 20px rgba( 4, 4, 5 ); ">SISTEMA DE INVENTARIOS</h1>
		</div>
		
		<div class="grid_4 omega" style="Margin-top:15px; padding-top:5px ">
			<br>
			<br>
			<span style="font-size:1.5em; color:#ebebeb;"><b>USUARIO: </b>&nbsp;<?php echo utf8_encode($this->session->userdata('US_NOMBRES'));?></span>
			<br />
			<br />
			<span style="font-size:1.5em; color:#ebebeb;"><b>PERFIL: </b>&nbsp;<?php echo utf8_encode($this->session->userdata('US_NOMBRE_PERFIL'));?></span>
			<br />
			<br />
			<span style="font-size:1.5em; color:#ebebeb;"><b>FECHA ACTUAL: </b>&nbsp;<?php echo @date("Y-m-d");?> <span id="time"><?php echo @date("H:i:s");?></span></span>
			<!--<br />
			<br />
			<span title="Empresas Asignadas al Usuario en Sesión" style="font-size:1.5em; color:#ebebeb;"><b>EMPRESA: </b>&nbsp;<?php echo comboArreglo(explode(",", $this->session->userdata('EMPRESA')),"combo_empresa");?></span>
			<br />
			<br />-->
		</div>
        
		<div id="c_menu_opciones"  class="grid_12">
			
		</div>
		<div id="contenido_general" class="grid_12 omega">
			<h2 style="z-index:-100;position:absolute;border: 0px solid #CCC; margin: 5em 0em 0em 0em; width:auto; height:auto; text-shadow: 1px 2px #999;">
				<p align="center">
				<img src="imagenes/istcre2.png" title="Instituto Superior Tecnológico Cruz Roja Ecuatoriana" class="img-responsive" width="650" height="600" />
				<font align="center" color="#000000">
				<!--<br><b>BIENVENIDOS<br> Escuela de Conductores Profesionales del Instituto Superior Cruz Roja, 
					Licencia Tipo C1 Resolución 073-DIR-ANT-2017</b>-->
					</font></p>
			</h2>
		</div>
	</div>
    <div id="dialog-form" title=""></div>	
	
	<div id="barra">
		
	</div>
	
	<div title="Menú del Sistema" id="c_menu_opciones" style="z-index:0;position:absolute;">
		
		<div id='cssmenu'>
			<ul> 
				<li><a id="e_peticion" name="hojaatencion/index" title="Descargas de Insumos" class="cabecera-links" href="#"></i>Descargas de Insumos</a></li>
				<?php if (($this->lib_usuarios->getAccesoSeccion($this->session->userdata('US_CODIGO'),'ADM')==1) or ($this->lib_usuarios->getAccesoSeccion($this->session->userdata('US_CODIGO'),'ADMS')==1) or ($this->lib_usuarios->getAccesoSeccion($this->session->userdata('US_CODIGO'),'LGS')==1)){?>
				<li><a id="e_transferencia" name="transferencia/index" title="Transferencias de Insumos" class="cabecera-links" href="#"></i>Transferencias de Insumos</a></li>
				
					<?php if (($this->lib_usuarios->getAccesoSeccion($this->session->userdata('US_CODIGO'),'ADM')==1) or ($this->lib_usuarios->getAccesoSeccion($this->session->userdata('US_CODIGO'),'ADMS')==1)){?>
						<li><a title="Módulo Administración de Empresas" href='#'><span>Reportes</span></a>
							<ul>													
									<li><a id="e_repproducto" name="reportes/index" title="Reporte de Productos" class="cabecera-links" href="#"></i>Reporte de Productos</a></li>			
							</ul>
						</li>
					<?php  } ?>
				
					<li><a title="Módulo Administración de Empresas" href='#'><span>Administración Productos</span></a>
						<ul>
							
							<?php if (($this->lib_usuarios->getAccesoSeccion($this->session->userdata('US_CODIGO'),'ADM')==1) or ($this->lib_usuarios->getAccesoSeccion($this->session->userdata('US_CODIGO'),'ADMS')==1)){?>
								<li><a id="e_productoxcantidad" name="productoxcantidad/index" title="Ingreso de Productos" class="cabecera-links" href="#"></i>Ingreso STOCK</a></li>
								<li><a id="e_producto" name="producto/index" title="Administración de Productos" class="cabecera-links" href="#"></i>Productos</a></li>
							<?php  } ?>
						</ul>
					</li>
					
					<li><a title="Módulo Administración de Empresas" href='#'><span>Administración</span></a>
						<ul>
							<?php if (($this->lib_usuarios->getAccesoSeccion($this->session->userdata('US_CODIGO'),'ADM')==1) or ($this->lib_usuarios->getAccesoSeccion($this->session->userdata('US_CODIGO'),'ADMS')==1)){?>
								<li><a title="Menú Administración Sistema" href='#'><span>Administración Sistema</span></a>
									<ul>
										<li><a id="e_categoria" name="categoria/index" title="Categorías de Productos" class="cabecera-links" href="#"></i>Categorías</a></li>
										<li><a id="e_bodega" name="bodega/index" title="Administración de Bodegas" class="cabecera-links" href="#"></i>Bodegas</a></li>								
										<li><a id="e_percha" name="percha/index" title="Administración de Perchas" class="cabecera-links" href="#"></i>Perchas</a></li>
										<li><a id="e_proveedor" name="proveedor/index" title="Administración de Proveedores" class="cabecera-links" href="#"></i>Proveedores</a></li>
										<li><a id="e_base" name="base/index" title="Administración de Bases" class="cabecera-links" href="#"></i>Bases</a></li>
										<li><a id="e_movil" name="movil/index" title="Administración de Moviles" class="cabecera-links" href="#"></i>Moviles</a></li>
									</ul>	
								</li>	
								<li><a title="Menú Administración Usuarios" href='#'><span>Administración Usuarios</span></a>
									<ul>
										<li><a id="e_usuario" name="usuario/index" title="Administración de Usuarios" class="cabecera-links" href="#"></i>Usuarios</a></li>
										<li><a id="e_usuarioxbase" name="usuarioxbase/index" title="Asignación Usuarios por Base" class="cabecera-links" href="#"></i>Usuarios por Base</a></li>
									</ul>	
								</li>	
							<?php  } ?>
						</ul>
					</li>	
				<?php  } ?>
<li><a id="e_salir" style="color:#FF0000; font-weight: bold;" title="Salida del Sistema(Cierre de Sesión)" class="titular" href="general/inicio/salir"><span>Salir</span></a></li>

</ul>
</div>
</div>
</body>
<script>
	$('#mostrar-nav').on('click',function(){
		$('nav').toggleClass('mostrar');
	})
	
	$(function(){
		
		/*$('#combo_empresa').trigger('change');		
		
		$('#combo_empresa').change(function(){
			var empresa= $('#combo_empresa').val();
			alert("!!...Cambio de Empresa A: "+empresa+"...!!");
			//var pagPrin = document.forms.principalImagen;
			//pagPrin.elements.caja.value = empresa;
			$('a').removeClass('ui-state-focus');
			$('#contenido_general').empty();
		});*/
		
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
	
	var FACTURACION = {
		intervalo: null,
		crearWijdialog: function(elemento, opciones){
			this.intervalo = self.setInterval(function(){
				FACTURACION.verificarCrearWijdialog(elemento, opciones)
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