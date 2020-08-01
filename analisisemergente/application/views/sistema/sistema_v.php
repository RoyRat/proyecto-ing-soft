<div id="accordion">
  <h3>Ingreso de Datos Para Un Sistema</h3>  
        <form id="fsistema">
            <div id="cabecera">
            <table width="95%"  id="tsistema" class="formDialog">    
			
					<tr>
                        <th>
                       Código(*)
                       </th>
                        <td>
                            <input type="text" maxlength="50" style="width:100px;" name="APP_CODIGO" id="APP_CODIGO" value="<?php echo !empty($sol->APP_CODIGO) ? ($sol->APP_CODIGO) : null ; ?>"  />
                       </td>
					   <th>
                       Nombre(*)
                       </th>
                        <td>
                            <input type="text" maxlength="50" style="width:200px;" name="APP_NOMBRE" id="APP_NOMBRE" value="<?php echo !empty($sol->APP_NOMBRE) ? ($sol->APP_NOMBRE) : null ; ?>"  />
                       </td>					   
                   </tr>
					<tr>
					<th>
                       Administrador
                       </th>
                        <td>
                            <input type="text" maxlength="20" style="width:100px;" name="APP_ADMINISTRADOR" id="APP_ADMINISTRADOR" value="<?php echo !empty($sol->APP_ADMINISTRADOR) ? ($sol->APP_ADMINISTRADOR) : null ; ?>" />
                       </td>	
						<th>
                       Versión
                       </th>
                        <td>
                            <input type="text" maxlength="13" style="width:100px;" name="APP_VERSION" id="APP_VERSION" value="<?php echo !empty($sol->APP_VERSION) ? ($sol->APP_VERSION) : null ; ?>"  />
                       </td>									   
                   </tr>
					
						<?php if($accion=='n'|$accion=='e') : ?>                    
                            
                             <td align="center" colspan="6" class="noclass">
                                <button title="Verifique la información antes de guardar." id="co_grabar" type="submit" ><img src="./imagenes/guardar.png" width="17" height="17"/>Grabar Sistema</button>
                             </td>
                    
						<?php endif; ?>
						
                </table>
            </div>
            <input type="hidden"  name="APP_SECUENCIAL" id="APP_SECUENCIAL" value="<?php echo !empty($sol->APP_SECUENCIAL) ? ($sol->APP_SECUENCIAL) : 0 ; ?>"  />
        </form>
</div>
