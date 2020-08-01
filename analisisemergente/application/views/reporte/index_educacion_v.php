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
						<input type="text" style="width:100px;" name="ED_FECHA_INGRESOINI" id="ED_FECHA_INGRESOINI" value="<?php echo !empty($ED_FECHA_INGRESOINI) ? ($ED_FECHA_INGRESOINI) : null ; ?>" />
					</td>
					<th class="field">
						Fecha Final (ingreso)
					</th>
					<td>
						<input type="text" style="width:100px;" name="ED_FECHA_INGRESOFIN" id="ED_FECHA_INGRESOFIN" value="<?php echo !empty($ED_FECHA_INGRESOFIN) ? ($ED_FECHA_INGRESOFIN) : null ; ?>" />
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
						Estado Civil
					</th>
					<td>
						<?php echo $estadoCivil;?>
					</td>
				</tr>
				<tr>
					<th class="field">
						Nivel de Formación
					</th>
					<td>
						<?php echo $nivelFormacion;?>
					</td>
					<th class="field">
						Posee Internet
					</th>
					<td>
						<?php echo $internet;?>
					</td>
				</tr>
			
				<tr>
					<th class="field">
						Número de Computadoras/Laptops
					</th>
					<td>
						<input type="number" style="width:100px;" min="0" step="1" max="999" name="ED_NUM_COMPUS" id="ED_NUM_COMPUS" value="<?php echo !empty($ED_NUM_COMPUS) ? prepCampoMostrar($ED_NUM_COMPUS) : 0 ; ?>" />
					</td>
					<th class="field">
						Número de Celulares
					</th>
					<td>
						<input type="number" style="width:100px;" min="0" step="1" max="999" name="ED_NUM_CELULARES" id="ED_NUM_CELULARES" value="<?php echo !empty($ED_NUM_CELULARES) ? prepCampoMostrar($ED_NUM_CELULARES) : 0 ; ?>" />
					</td>
				</tr>
				<tr>
					<th class="field">
						Número de Tablets/Ipads
					</th>
					<td>
						<input type="number" style="width:100px;" min="0" step="1" max="999" name="ED_NUM_TABLETS" id="ED_NUM_TABLETS" value="<?php echo !empty($ED_NUM_TABLETS) ? prepCampoMostrar($ED_NUM_TABLETS) : 0 ; ?>" />
					</td>
					<th class="field">
						Número de Estudiantes Universitarios
					</th>
					<td>
						<input type="number" style="width:100px;" min="0" step="1" max="999" name="ED_NUM_ESTUD_UNIV" id="ED_NUM_ESTUD_UNIV" value="<?php echo !empty($ED_NUM_ESTUD_UNIV) ? prepCampoMostrar($ED_NUM_ESTUD_UNIV) : 0 ; ?>" />
					</td>
				</tr>
				<tr>
					<th class="field">
						Número de Estudiantes Escuelas/Colegios
					</th>
					<td>
						<input type="number" style="width:100px;" min="0" step="1" max="999" name="ED_NUM_ESTUD_EAC" id="ED_NUM_ESTUD_EAC" value="<?php echo !empty($ED_NUM_ESTUD_EAC) ? prepCampoMostrar($ED_NUM_ESTUD_EAC) : 0 ; ?>" />
					</td>
					<th class="field">
						Número de Escuelas/Colegios
					</th>
					<td>
						<input type="number" style="width:100px;" min="0" step="1" max="999" name="ED_NUM_ESCCOL" id="ED_NUM_ESCCOL" value="<?php echo !empty($ED_NUM_ESCCOL) ? prepCampoMostrar($ED_NUM_ESCCOL) : 0 ; ?>" />
					</td>
				</tr>
				<tr>
					<th class="field">
						Número de Universidades/Institutos
					</th>
					<td colspan="3">
						<input type="number" style="width:100px;" min="0" step="1" max="999" name="ED_NUM_UNIVERSIDADES" id="ED_NUM_UNIVERSIDADES" value="<?php echo !empty($ED_NUM_UNIVERSIDADES) ? prepCampoMostrar($ED_NUM_UNIVERSIDADES) : 0 ; ?>" />
					</td>
				</tr>
			</table>
		</form>
		<table id="itemSalud" class="scroll" cellpadding="0" cellspacing="0"></table>
		<div id="pitemSalud" class="scroll" style="text-align:center;"></div>
	</div>
</div>