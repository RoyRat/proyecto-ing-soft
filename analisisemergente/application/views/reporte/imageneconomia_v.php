<style>
table.detalle td , table.detalle th{
        border:1px solid black;
        border-collapse:collapse;
        margin:  5px;
	}
	
.estilo1 { 
font-family: Arial, Helvetica, sans-serif; 
font-size: 30px; 
} 
</style>
<script type="text/javascript">
//HIGHCHARTS
$(function () {	
/**
 * Grid-light theme for Highcharts JS
 * @author Torstein Honsi
 */

// Load the fonts
/*Highcharts.createElement('link', {
   href: '//fonts.googleapis.com/css?family=Dosis:400,600',
   rel: 'stylesheet',
   type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);*/

Highcharts.theme = {
   colors: ["#333333", "#00cc99", "#0066cc", "#ffcc00", "#ff3333", "#ff0066", "#eeaaee",
      "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
   chart: {
      backgroundColor: null,
      style: {
         fontFamily: "Dosis, sans-serif"
      }
   },
   title: {
      style: {
         fontSize: '16px',
         fontWeight: 'bold',
         textTransform: 'uppercase'
      }
   },
   tooltip: {
      borderWidth: 0,
      backgroundColor: 'rgba(219,219,216,0.8)',
      shadow: false
   },
   legend: {
      itemStyle: {
         fontWeight: 'bold',
         fontSize: '13px'
      }
   },
   xAxis: {
      gridLineWidth: 1,
      labels: {
         style: {
            fontSize: '12px'
         }
      }
   },
   yAxis: {
      minorTickInterval: 'auto',
      title: {
         style: {
            textTransform: 'uppercase'
         }
      },
      labels: {
         style: {
            fontSize: '12px'
         }
      }
   },
   plotOptions: {
      candlestick: {
         lineColor: '#404048',
		 lineWidth: 8
      }
   },

   // General
   background2: '#F0F0EA'

};

// Aplica el tema en la grafica actual
Highcharts.setOptions(Highcharts.theme);
	
	//Variables de Datos 
	var categorias = <?php echo $categorias; ?>; //variable de consulta de la base de datos
	var container = <?php echo $container; ?>; //variable de consulta de la base de datos
	var TITULODESCARGA = <?php echo $TITULODESCARGA; ?>; //variable de consulta de la base de datos
	var SI = <?php echo $SI; ?>; //variable de consulta de la base de datos
	var NO = <?php echo $NO; ?>; //variable de consulta de la base de datos
	var nombrearchivo = <?php echo $nombrearchivo; ?>; //variable de consulta de la base de datos
	var CATEGORIAFNUM = <?php echo $CATEGORIAFNUM; ?>; //variable de consulta de la base de datos
	var CATEGORIAFVAL = <?php echo $CATEGORIAFVAL; ?>; //variable de consulta de la base de datos
	var CATEGORIAHNUM = <?php echo $CATEGORIAHNUM; ?>; //variable de consulta de la base de datos
	var CATEGORIAHVAL = <?php echo $CATEGORIAHVAL; ?>; //variable de consulta de la base de datos
	
	for(var i=0;i<container.length;i++){
	if(TITULODESCARGA[i]=='SALUD-FARMACIAS'){
		//Variable del Grafico
		 var chart = new Highcharts.Chart({
			 
			//configuraciones del grafico 
			chart: {
				renderTo: container[i],
				type: 'column', //tipos de grafico: line,column,pie,area,areaspline,scatter,spline
				margin: 75,
				options3d: {
					enabled: false,
					alpha: 15,
					beta: 15,
					depth: 50,
					viewDistance: 25
				},
				reflow: true
			},
			//titulo del grafico
			title: {
				text: container[i]
				//text: empresa+'<br>'+proceso+'<br>'+cargo
			},
			//subtitulo del grafico
			subtitle: {
				text: 'INDICADOR SALUD'
			},
			//creditos del grafico 
			credits: {
				enabled: true,
				href: 'https://www.utpl.edu.ec',
				text: 'UTPL',
				target: '_blank'
			},
			//titulo de eje X
			xAxis: {
				categories: CATEGORIAFNUM,
				crosshair: true
			},
			//titulo de eje y
			yAxis: {
				min: 0,
				title: {
					text: ''
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><br>',
				valueSuffix: ''
			},
			//Opciones de navegación
			navigation: {
				buttonOptions: {
					enabled: true
				}
			},
			//opciones de exportacion
			exporting: {
				allowHTML: true,
				sourceWidth: 1600,
				sourceHeight: 800,
				filename: TITULODESCARGA[i]
				/*,
				buttons: {
					contextButton: {
						symbol: 'circle',
						symbolStrokeWidth: 1,
						symbolFill: '#78BC73',
						symbolStroke: '#FFFFFF',
						text: '<b>Descargar</b>',					
						onclick: function () {
							chart.exportChart({
								type: 'image/png',
								url:'js/Highcharts/exporting-server/index.php',
								filename: nombrearchivo[i]});
						}
					}
				}*/
			},
			//opciones del ploteo
			 plotOptions: {
				column: {
					depth: 25,
					animation: true,
					borderColor: "",
					borderWidth: 1
				}
			}, 
			//titulos de las series y valores a mostrar
			series: [{
				name: container[i],
				data: CATEGORIAFVAL,
				pointWidth: 20

			}]
			
		});
		
		//Evento para descargar automaticamente el grafico
		function cargaInfo(){
			chart.exportChart({
								enabled: true,
								fallbackToExportServer: true,
								type: 'image/png', 
								url:'js/Highcharts/exporting-server/index.php',
								filename: nombrearchivo[i]
							});
			//chart.print(); //funcion para imprimir automaticamente				
		}		
		
		//funciones para mostrar valores en 3D
		function showValues() {
			$('#R0-value').html(chart.options.chart.options3d.alpha);
			$('#R1-value').html(chart.options.chart.options3d.beta);
		}

		// Activa navegación eje y
		$('#R0').on('change', function () {
			chart.options.chart.options3d.alpha = this.value;
			showValues();
			chart.redraw(false);
		});
		
		// Activa navegación eje x
		$('#R1').on('change', function () {
			chart.options.chart.options3d.beta = this.value;
			showValues();
			chart.redraw(false);
		});

		showValues();
		cargaInfo();
	}else if(TITULODESCARGA[i]=='SALUD-HOSPITALESCLINICAS'){
		//Variable del Grafico
		 var chart = new Highcharts.Chart({
			 
			//configuraciones del grafico 
			chart: {
				renderTo: container[i],
				type: 'column', //tipos de grafico: line,column,pie,area,areaspline,scatter,spline
				margin: 75,
				options3d: {
					enabled: false,
					alpha: 15,
					beta: 15,
					depth: 50,
					viewDistance: 25
				},
				reflow: true
			},
			//titulo del grafico
			title: {
				text: container[i]
				//text: empresa+'<br>'+proceso+'<br>'+cargo
			},
			//subtitulo del grafico
			subtitle: {
				text: 'INDICADOR SALUD'
			},
			//creditos del grafico 
			credits: {
				enabled: true,
				href: 'https://www.utpl.edu.ec',
				text: 'UTPL',
				target: '_blank'
			},
			//titulo de eje X
			xAxis: {
				categories: CATEGORIAHNUM,
				crosshair: true
			},
			//titulo de eje y
			yAxis: {
				min: 0,
				title: {
					text: ''
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><br>',
				valueSuffix: ''
			},
			//Opciones de navegación
			navigation: {
				buttonOptions: {
					enabled: true
				}
			},
			//opciones de exportacion
			exporting: {
				allowHTML: true,
				sourceWidth: 1600,
				sourceHeight: 800,
				filename: TITULODESCARGA[i]
				/*,
				buttons: {
					contextButton: {
						symbol: 'circle',
						symbolStrokeWidth: 1,
						symbolFill: '#78BC73',
						symbolStroke: '#FFFFFF',
						text: '<b>Descargar</b>',					
						onclick: function () {
							chart.exportChart({
								type: 'image/png',
								url:'js/Highcharts/exporting-server/index.php',
								filename: nombrearchivo[i]});
						}
					}
				}*/
			},
			//opciones del ploteo
			 plotOptions: {
				column: {
					depth: 25,
					animation: true,
					borderColor: "",
					borderWidth: 1
				}
			}, 
			//titulos de las series y valores a mostrar
			series: [{
				name: container[i],
				data: CATEGORIAHVAL,
				pointWidth: 20

			}]
			
		});
		
		//Evento para descargar automaticamente el grafico
		function cargaInfo(){
			chart.exportChart({
								enabled: true,
								fallbackToExportServer: true,
								type: 'image/png', 
								url:'js/Highcharts/exporting-server/index.php',
								filename: nombrearchivo[i]
							});
			//chart.print(); //funcion para imprimir automaticamente				
		}		
		
		//funciones para mostrar valores en 3D
		function showValues() {
			$('#R0-value').html(chart.options.chart.options3d.alpha);
			$('#R1-value').html(chart.options.chart.options3d.beta);
		}

		// Activa navegación eje y
		$('#R0').on('change', function () {
			chart.options.chart.options3d.alpha = this.value;
			showValues();
			chart.redraw(false);
		});
		
		// Activa navegación eje x
		$('#R1').on('change', function () {
			chart.options.chart.options3d.beta = this.value;
			showValues();
			chart.redraw(false);
		});

		showValues();
		cargaInfo();
	}else{
		//Variable del Grafico
		 var chart = new Highcharts.Chart({
			 
			//configuraciones del grafico 
			chart: {
				renderTo: container[i],
				type: 'column', //tipos de grafico: line,column,pie,area,areaspline,scatter,spline
				margin: 75,
				options3d: {
					enabled: false,
					alpha: 15,
					beta: 15,
					depth: 50,
					viewDistance: 25
				},
				reflow: true
			},
			//titulo del grafico
			title: {
				text: container[i]
				//text: empresa+'<br>'+proceso+'<br>'+cargo
			},
			//subtitulo del grafico
			subtitle: {
				text: 'INDICADOR SALUD'
			},
			//creditos del grafico 
			credits: {
				enabled: true,
				href: 'https://www.utpl.edu.ec',
				text: 'UTPL',
				target: '_blank'
			},
			//titulo de eje X
			xAxis: {
				categories: [categorias[i]],
				crosshair: true
			},
			//titulo de eje y
			yAxis: {
				min: 0,
				title: {
					text: ''
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><br>',
				valueSuffix: ''
			},
			//Opciones de navegación
			navigation: {
				buttonOptions: {
					enabled: true
				}
			},
			//opciones de exportacion
			exporting: {
				allowHTML: true,
				sourceWidth: 1600,
				sourceHeight: 800,
				filename: TITULODESCARGA[i]
				/*,
				buttons: {
					contextButton: {
						symbol: 'circle',
						symbolStrokeWidth: 1,
						symbolFill: '#78BC73',
						symbolStroke: '#FFFFFF',
						text: '<b>Descargar</b>',					
						onclick: function () {
							chart.exportChart({
								type: 'image/png',
								url:'js/Highcharts/exporting-server/index.php',
								filename: nombrearchivo[i]});
						}
					}
				}*/
			},
			//opciones del ploteo
			 plotOptions: {
				column: {
					depth: 25,
					animation: true,
					borderColor: "",
					borderWidth: 1
				}
			}, 
			//titulos de las series y valores a mostrar
				series: [{
				name: 'SI',
				data: SI[i],
				pointWidth: 70

				}, {
					name: 'NO',
					data: NO[i],
					pointWidth: 70

				}]
			
		});
		
		//Evento para descargar automaticamente el grafico
		function cargaInfo(){
			chart.exportChart({
								enabled: true,
								fallbackToExportServer: true,
								type: 'image/png', 
								url:'js/Highcharts/exporting-server/index.php',
								filename: nombrearchivo[i]
							});
			//chart.print(); //funcion para imprimir automaticamente				
		}		
		
		//funciones para mostrar valores en 3D
		function showValues() {
			$('#R0-value').html(chart.options.chart.options3d.alpha);
			$('#R1-value').html(chart.options.chart.options3d.beta);
		}

		// Activa navegación eje y
		$('#R0').on('change', function () {
			chart.options.chart.options3d.alpha = this.value;
			showValues();
			chart.redraw(false);
		});
		
		// Activa navegación eje x
		$('#R1').on('change', function () {
			chart.options.chart.options3d.beta = this.value;
			showValues();
			chart.redraw(false);
		});

		showValues();
		cargaInfo();
	}
	}
	
});

</script>
<div id="accordion">
<h3>GRÁFICA</h3>
	<?php for($i=0;$i<count($containerArray);$i++){?>
		<div id="<?php echo $containerArray[$i];?>" style="min-width: 1200px; height: 500px; margin: 0 auto;" ></div>
	<?php }?>
</div>