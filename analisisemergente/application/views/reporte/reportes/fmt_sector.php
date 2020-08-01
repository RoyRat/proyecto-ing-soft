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
<table width="100%">
	<tr>
		<th>
			<p align="center">
			<h1>			
			<img src="./imagenes/cliente2.png" WIDTH="1350" HEIGHT="400"/>
				<br>
				<br>
				INDICADOR POR SECTOR
			</h1>
			</p>
		</th>
	</tr>				
</table>
<br>
<table class="detalle" width="100%">
	<tr>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >No</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Tipo Documento</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" ># Documento</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Apellidos</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Nombres</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Fecha Nacimiento</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Celular</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Convencional</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Correo</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Pais Nacimiento</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Provincia Nacimiento</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Cantón Nacimiento</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >País Reside</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Provincia Reside</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Cantón Reside</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >País Sufragio</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Provincia Sufragio</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Cantón Sufragio</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Sector Sufragio</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Género</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Estado Civil</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Tipo de Sangre</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Cargo Discapacitado</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Posee Discapacidad</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >% Discapacidad</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Carné Discapacidad</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Tipo Discapacidad</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Posee Enfermedades</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Enfermedades</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Posee Alergias</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Alergias</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Usa Medicación</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Medicación</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" ># Farmacias</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" ># Hospitales/Clinicas</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Cerca MSP</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Fecha Ingreso</th>
		<th align="center" style="font-weight:bold;background-color:#D1DBDC" >Estado</th>
	</tr>
	<?php foreach($consultas as $consulta){ ?>
		<tr>
			<td align="center" ><?php echo $consulta['SD_SECUENCIAL']; ?></td>
			<td align="center" ><?php echo ($consulta['SD_TIPODOCUMENTO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_CEDULA']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_APELLIDOS']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_NOMBRES']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_FECHA_NACIMIENTO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_CELULAR']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_CONVENCIONAL']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_CORREO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_PAIS_NACIMIENTO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_PROVINCIA_NACIMIENTO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_CANTON_NACIMIENTO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_PAIS_RESIDE']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_PROVINCIA_RESIDE']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_CANTON_RESIDE']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_PAIS_SUFRAGIO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_PROVINCIA_SUFRAGIO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_CANTON_SUFRAGIO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_SECTOR_SUFRAGIO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_GENERO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_ESTADO_CIVIL']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_TIPO_SANGRE']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_CARGO_DISCAPACITADO']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_POSEE_DISCPACIDAD']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_PORCENTAJE_DISCAP']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_CARNE_CONADIS']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_TIPO_DISCAP']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_POSEE_ENFERMEDAD']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_ENFERMEDADDES']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_POSEE_ALERGIA']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_ALERGIADES']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_POSEE_MEDICACION']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_MEDICACIONDES']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_NUM_FARMACIAS']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_NUM_HOSPITALES']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_CERCA_MSP']); ?></td>
			<td align="center" ><?php echo ($consulta['SD_FECHA_INGRESO']); ?></td>
			<td align="center" ><?php 						
				if($consulta['SD_ESTADO']==0){
					echo ('<font color="#0D9300">ACEPTADO</font>');
				}else{
					echo ('<font color="#A40093">RECHAZADO</font>'); 
				}
			?></td>
		</tr>
	<?php } ?>	
</table>
<br>
<div>
<p align="center">
<h1>GRÀFICAS</h1>
</p>
<br>
<br>
<?php for($i=0;$i<count($imagenes);$i++){?>
<br>
<h2><?php echo $tituloGrafica[$i]?></h2>
<br>
<img src="<?php echo buscaExtension('./js/Highcharts/exporting-server/temp/'.$imagenes[$i]);?>" WIDTH="3300" HEIGHT="1500"/>
<?php } ?>
</div>