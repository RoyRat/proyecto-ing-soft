<div class="ui-dialog ui-dialog-princial ui-widget ui-widget-content ui-corner-all ui-main-title" title="Reporte de Salud">
	<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
		<span id="ui-dialog-title-dialog" class="ui-dialog-title">Reporte de Salud</span>
	</div>
	<div id="d_consultaSalud"  title="Reporte de Salud">
		<form id="itemSalud2">
			<table width="95%" class="formDialog">
				<tr>
					<th class="field">
						Fecha Inicio (ingreso)
					</th>
					<td>
						<input type="text" style="width:100px;" name="SD_FECHA_INGRESOINI" id="SD_FECHA_INGRESOINI" value="<?php echo !empty($SD_FECHA_INGRESOINI) ? ($SD_FECHA_INGRESOINI) : null ; ?>" />
					</td>
					<th class="field">
						Fecha Final (ingreso)
					</th>
					<td>
						<input type="text" style="width:100px;" name="SD_FECHA_INGRESOFIN" id="SD_FECHA_INGRESOFIN" value="<?php echo !empty($SD_FECHA_INGRESOFIN) ? ($SD_FECHA_INGRESOFIN) : null ; ?>" />
					</td>
				</tr>					
				<tr>
					<th class="field">
						Genero
					</th>
					<td>
						<?php echo $genero;?>
					</td>
					<th class="field">
						Tipo de Sangre
					</th>
					<td>
						<?php echo $tipoSangre;?>
					</td>
				</tr>
				<tr>
					<th class="field">
						Cargo Discapacitado
					</th>
					<td>
						<?php echo $cargoDiscapacitado;?>
					</td>
					<th class="field">
						Discapacitados
					</th>
					<td>
						<?php echo $discapacidad;?>
					</td>
				</tr>
				<tr>
					<th class="field">
						Tipo Discapacidad
					</th>
					<td colspan="3">
						<?php echo $tipoDiscapacidad;?>
					</td>
				</tr>
				<tr>
					<th class="field">
						Enfermedades
					</th>
					<td>
						<?php echo $enfermedades;?>
					</td>
					<th class="field">
						Alergias
					</th>
					<td>
						<?php echo $alergias;?>
					</td>
				</tr>
				<tr>
					<th class="field">
						Medicación
					</th>
					<td>
						<?php echo $medicacion;?>
					</td>
					<th class="field">
						Cerca MSP
					</th>
					<td>
						<?php echo $cercamsp;?>
					</td>
				</tr>
				<tr>
					<th class="field">
						Número de Farmacias
					</th>
					<td>
						<input type="number" style="width:100px;" min="0" step="1" max="999" name="SD_NUM_FARMACIAS" id="SD_NUM_FARMACIAS" value="<?php echo !empty($SD_NUM_FARMACIAS) ? prepCampoMostrar($SD_NUM_FARMACIAS) : 0 ; ?>" />
					</td>
					<th class="field">
						Número de Hospitales
					</th>
					<td>
						<input type="number" style="width:100px;" min="0" step="1" max="999" name="SD_NUM_HOSPITALES" id="SD_NUM_HOSPITALES" value="<?php echo !empty($SD_NUM_HOSPITALES) ? prepCampoMostrar($SD_NUM_HOSPITALES) : 0 ; ?>" />
					</td>
				</tr>
			</table>
		</form>
		<table id="itemSalud" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pitemSalud" class="scroll" style="text-align:center;"></div>
	</div>
</div>