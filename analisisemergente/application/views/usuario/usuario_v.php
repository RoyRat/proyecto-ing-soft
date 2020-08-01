<div id="accordion">
	<form id="fusuario">
		<div id="cabecera">
            <table width="100%"  id="tusuario" class="formDialog">  
				<tr>
					<th>
						<h5> Cédula o Pasaporte</h5>
					</th>
					<td>
						<input class='inputcss' type="text" maxlength="100" style="width:150px;" name="US_CEDULA" id="US_CEDULA" value="<?php echo !empty($sol->US_CEDULA) ? ($sol->US_CEDULA) : null ; ?>" placeholder="Cédula o Pasaporte"  />
					</td>
					<th>
						<h5> Nombres(*)</h5>
					</th>
					<td>
						<input class='inputcss' type="text" maxlength="100" style="width:150px;" name="US_NOMBRES" id="US_NOMBRES" value="<?php echo !empty($sol->US_NOMBRES) ? ($sol->US_NOMBRES) : null ; ?>" placeholder="Nombres Completos"  />
					</td>
					<th>
						<h5>Apellidos(*)</h5>
					</th>
					<td>
						<input class='inputcss' type="text" maxlength="100" style="width:150px;" name="US_APELLIDOS" id="US_APELLIDOS" value="<?php echo !empty($sol->US_APELLIDOS) ? ($sol->US_APELLIDOS) : null ; ?>" placeholder="Apellidos Completos" />
					</td>
				</tr>
				
				<tr>
					<th>
						<h5>Código(*)</h5>
					</th>
					<td>
                            <input class='inputcss' type="text" maxlength="100" style="width:150px;" name="US_CODIGO" id="US_CODIGO" value="<?php echo !empty($sol->US_CODIGO) ? ($sol->US_CODIGO) : null ; ?>" placeholder="Código" />
                    </td>
					<th>
						<h5>Siglas</h5>
					</th>
					<td>
						<input class='inputcss' type="text" maxlength="100" style="width:150px;" name="US_SIGLAS" id="US_SIGLAS" value="<?php echo !empty($sol->US_SIGLAS) ? ($sol->US_SIGLAS) : null ; ?>" placeholder="Iniciales de Nombres" />
					</td>
					<th>
						<h5>E-mail(*)</h5>
					</th>
					<td>
						<input class='inputcss' type="text" maxlength="100" style="width:150px;" name="US_MAIL" id="US_MAIL" value="<?php echo !empty($sol->US_MAIL) ? ($sol->US_MAIL) : null ; ?>" placeholder="nombre@ejemplo.com" />
					</td>									
				</tr>
				
				<tr>
					<th>
						<h5>Pais(*)</h5>
					</th>
					<td>
						<?php echo $combo_pais; ?> 
					</td>
					<th>
						<h5> Provincia(*)</h5>
					</th>
					<td>
						<?php echo $combo_provincia; ?> 
					</td>
					<th>
						<h5>Ciudad(*)</h5>
					</th>
					<td>
						<?php echo $combo_ciudad; ?> 
					</td>
				</tr>			
				
				<tr>
					<th>
						<h5>Sector(*)</h5>
					</th>
					<td>
						<?php echo $combo_sector; ?> 
					</td>
					
					<th>
						<h5>Teléfono Celular</h5>
					</th>
					<td>
						<input class='inputcss' type="text" maxlength="100" style="width:150px;" name="US_CELULAR" id="US_CELULAR" value="<?php echo !empty($sol->US_CELULAR) ? ($sol->US_CELULAR) : null ; ?>" placeholder="Ej: 09 12345678" />
					</td>                        
					<th>
						<h5>Teléfono Convencional</h5>
					</th>
					<td>
						<input class='inputcss' type="text" maxlength="100" style="width:150px;" name="US_CONVENCIONAL" id="US_CONVENCIONAL" value="<?php echo !empty($sol->US_CONVENCIONAL) ? ($sol->US_CONVENCIONAL) : null ; ?>" placeholder="Ej: 02 1234567" />
					</td>
				</tr>				
				
				<tr>
					<th>
						Dirección
					</th>
					<td colspan=6>
						<TEXTAREA maxlength="499" style="width:500px;" rows="1" cols="30" id="US_DIRECCION" name="US_DIRECCION"> <?php echo (!empty($sol->US_DIRECCION))?($sol->US_DIRECCION):null; ?>  </TEXTAREA> 
					</td>
				</tr>	
				
				<?php if($accion=='n'|$accion=='e') : ?>                    
				
				<td align="center" colspan="6" class="noclass">
					<button title="Revise Su Información Antes de Continuar." id="co_grabar" type="submit" >Grabar Usuario</button>
				</td>
				
				<?php endif; ?>
				
			</table>
		</div>
		<input type="hidden"  name="US_SECUENCIAL" id="US_SECUENCIAL" value="<?php echo !empty($sol->US_SECUENCIAL) ? ($sol->US_SECUENCIAL) : 0 ; ?>"  />
	</form>
</div>

