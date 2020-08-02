<?php
class Mhoja extends CI_Model {
   
	//funcion para crear un nuevo registro
	//Cambio para demo de uso de github
    function addHoja(){			
			$sqlfecha="select DATE_FORMAT(SYSDATE(),'%d/%m/%Y %H:%i:%s') FECHA from dual";
			$FECHA=$this->db->query($sqlfecha)->row()->FECHA;
			$FORM_FECHA_INGRESO="STR_TO_DATE('".$FECHA."','%d/%m/%Y %H:%i:%s')";
			
			//DATOS PERSONALES
			$FORM_TIPODOCUMENTO=($this->input->post('documento'));
			$FORM_CEDULA=($this->input->post('FORM_CEDULA'));
			$FORM_APELLIDOS=($this->input->post('FORM_APELLIDOS'));
			$FORM_NOMBRES=($this->input->post('FORM_NOMBRES'));
			$FORMFECHANACIMIENTO=($this->input->post('FORM_FECHA_NACIMIENTO'));
            $FORM_FECHA_NACIMIENTO="STR_TO_DATE('".$FORMFECHANACIMIENTO."','%Y-%m-%d')";
			$FORM_CELULAR=($this->input->post('FORM_CELULAR'));
			$FORM_CONVENCIONAL=($this->input->post('FORM_CONVENCIONAL'));
			$CORREOPERSONAL=($this->input->post('FORM_CORREO_PERSONAL'));
			if(!empty($CORREOPERSONAL)){
				$FORM_CORREO_PERSONAL=$CORREOPERSONAL;
			}else{
				$FORM_CORREO_PERSONAL=null;
			}		
			//NACIONALIDAD
			$FORMNACIONALIDAD=($this->input->post('paisnacionalidad'));
			if($FORMNACIONALIDAD=='OT'){
				$FORM_PAIS_NACIMIENTO=($this->input->post('FORM_PAIS_NACIMIENTO'));
				$FORM_PROVINCIA_NACIMIENTO=($this->input->post('FORM_PROVINCIA_NACIMIENTO'));
				$FORM_CANTON_NACIMIENTO=($this->input->post('FORM_CANTON_NACIMIENTO'));
			}else{
				$FORM_PAIS_NACIMIENTO=($this->input->post('paisnacionalidad'));
				$FORM_PROVINCIA_NACIMIENTO=($this->input->post('provincianacionalidad'));
				$FORM_CANTON_NACIMIENTO=($this->input->post('ciudadnacionalidad'));
			}
			
			//RESIDENCIA
			$FORMPAISRESIDE=($this->input->post('paisreside'));
			if($FORMPAISRESIDE=='OT'){
				$FORM_PAIS_RESIDE=($this->input->post('FORM_PAIS_RESIDE'));
				$FORM_PROVINCIA_RESIDE=($this->input->post('FORM_PROVINCIA_RESIDE'));
				$FORM_CANTON_RESIDE=($this->input->post('FORM_CANTON_RESIDE'));
			}else{
				$FORM_PAIS_RESIDE=($this->input->post('paisreside'));
				$FORM_PROVINCIA_RESIDE=($this->input->post('provinciareside'));
				$FORM_CANTON_RESIDE=($this->input->post('ciudadreside'));
			}
			
			//SUFRAGIO
			$FORMPAISSUFRAG=($this->input->post('paissufragio'));
			if($FORMPAISSUFRAG=='OT'){
				$FORM_PAIS_SUFRAGIO=($this->input->post('FORM_PAIS_SUFRAGIO'));
				$FORM_PROVINCIA_SUFRAGIO=($this->input->post('FORM_PROVINCIA_SUFRAGIO'));
				$FORM_CANTON_SUFRAGIO=($this->input->post('FORM_CANTON_SUFRAGIO'));
				$FORM_SECTOR_SUFRAGIO=($this->input->post('FORM_SECTOR_SUFRAGIO'));
			}else{
				$FORM_PAIS_SUFRAGIO=($this->input->post('paissufragio'));
				$FORM_PROVINCIA_SUFRAGIO=($this->input->post('provinciasufragio'));
				$FORM_CANTON_SUFRAGIO=($this->input->post('ciudadsufragio'));
				$FORM_SECTOR_SUFRAGIO=($this->input->post('sectorsufragio'));
			}
			$FORM_DIRECCION=($this->input->post('FORM_DIRECCION'));			
			$FORM_GENERO=($this->input->post('genero'));
			$FORM_ESTADO_CIVIL=($this->input->post('civil'));
			$FORM_TIPO_SANGRE=($this->input->post('tipoSangre'));
			$FORM_ETNIA=($this->input->post('etnia'));
			$FORM_PUEBLOS=($this->input->post('pueblos'));
			
			//CONTACTO DE EMRGENCIA
			$FORM_NOMBRES_CONTACTO=($this->input->post('FORM_NOMBRES_CONTACTO'));
			$FORM_RELACION_CONTACTO=($this->input->post('relcontacto'));
			$FORM_CELULAR_CONTACTO=($this->input->post('FORM_CELULAR_CONTACTO'));
			$FORM_COVENCIONAL_CONTACTO=($this->input->post('FORM_COVENCIONAL_CONTACTO'));
			$FORM_CORREO_CONTACTO=($this->input->post('FORM_CORREO_CONTACTO'));			
			
			//EDUCACION
			$FORM_NIVEL_FORMACION=($this->input->post('formacion'));
			$FORM_INGLES=($this->input->post('idioma'));
			$FORM_NUM_COMPUS=($this->input->post('FORM_NUM_COMPUS'));
			$FORM_NUM_CELULARES=($this->input->post('FORM_NUM_CELULARES'));
			$FORM_NUM_TABLETS=($this->input->post('FORM_NUM_TABLETS'));
			$FORM_POSEE_INTERNET=($this->input->post('internet'));
			$FORM_NUM_ESTUD_UNIV=($this->input->post('FORM_NUM_ESTUD_UNIV'));
			$FORM_NUM_ESTUD_EAC=($this->input->post('FORM_NUM_ESTUD_EAC'));
			$FORM_NUM_ESCCOL=($this->input->post('FORM_NUM_ESCCOL'));
			$FORM_NUM_UNIVERSIDADES=($this->input->post('FORM_NUM_UNIVERSIDADES'));
			
			//SALUD			
			$FORM_CARGO_DISCAPACITADO=($this->input->post('cargodiscapacidad'));
			$FORM_POSEE_DISCAPACIDAD=($this->input->post('discapacidad'));
			$PORDISCAPACIDAD=($this->input->post('FORM_PORCENTAJE_DISCAP'));
			if(!empty($PORDISCAPACIDAD)){
				$FORM_PORCENTAJE_DISCAP=$PORDISCAPACIDAD;
			}else{
				$FORM_PORCENTAJE_DISCAP=0;
			}
			$FORM_CARNE_CANDIS=($this->input->post('FORM_CARNE_CANDIS'));
			$FORMTIPODISCAPACIDAD=($this->input->post('tipoDiscapacidad'));
			if(!empty($FORMTIPODISCAPACIDAD)){
				$FORM_TIPO_DISCAP=$FORMTIPODISCAPACIDAD;
			}else{
				$FORM_TIPO_DISCAP=0;
			}
			$FORM_POSEE_ENFERMEDAD=($this->input->post('enfermedad'));
			$FORM_ENFERMEDADDES=($this->input->post('FORM_ENFERMEDADDES'));
			$FORM_POSEE_ALERGIA=($this->input->post('alergia'));
			$FORM_ALERGIADES=($this->input->post('FORM_ALERGIADES'));
			$FORM_POSEE_MEDICACION=($this->input->post('medicacion'));
			$FORM_MEDICACIONDES=($this->input->post('FORM_MEDICACIONDES'));
			$FORM_NUM_FARMACIAS=($this->input->post('FORM_NUM_FARMACIAS'));
			$FORM_NUM_HOSPITALES=($this->input->post('FORM_NUM_HOSPITALES'));
			$FORM_CERCA_MSP=($this->input->post('cercamsp'));
			
			//ECONOMIA
			$FORM_NUM_FAMILIA=($this->input->post('FORM_NUM_FAMILIA'));
			$FORM_NUM_HIJOS=($this->input->post('FORM_NUM_HIJOS'));
			$FORM_CANT_INGRESOS=($this->input->post('FORM_CANT_INGRESOS'));
			$FORM_RECIBE_BONO=($this->input->post('bono'));			
			$FORM_LABORA=($this->input->post('trabajo'));			
			$FORM_HORARIO_LABORA=($this->input->post('FORM_HORARIO_LABORA'));
			$FORM_USA_INGRESOS=($this->input->post('usoIngresos'));
			$FORM_INGRESOSDES=($this->input->post('FORM_INGRESOSDES'));
			$FORM_VIVIENDA=($this->input->post('vivienda'));
			
			//SEGURIDAD
			$FORM_CERCA_RETEN=($this->input->post('cercareten'));
			$FORM_NUM_PATRULLAJES=($this->input->post('FORM_NUM_PATRULLAJES'));
			$FORM_ALARMA_COMUNITARIA=($this->input->post('alarma'));
			$FORM_NUM_ROBOS=($this->input->post('FORM_NUM_ROBOS'));
			$FORM_FRECUENCIA_ROBOS=($this->input->post('frecuencia'));
			$FORM_LUGAR_ROBOS=($this->input->post('lugarrobos'));
			$FORM_LUGAR_ROBODES=($this->input->post('FORM_LUGAR_ROBODES'));
			
			//REDES SOCIALES
			$FORM_USA_REDES=($this->input->post('redsocial'));
			if($FORM_USA_REDES==1){
					$TIPOREDSOCIALEV=$this->input->post('FORM_TIPOREDSOCIAL[]');
					if(!empty($TIPOREDSOCIALEV)){
						$TIPOREDSOCIAL=implode(",",$TIPOREDSOCIALEV);
						$FORM_TIPOS_REDES=$TIPOREDSOCIAL;
					}else{
						$FORM_TIPOS_REDES=null;
					}
				}else{
					$FORM_TIPOS_REDES=null;
				}
			
			//UBICACION	
			$FORM_LATITUD=($this->input->post('FORM_LATITUD'));
			$FORM_LONGITUD=($this->input->post('FORM_LONGITUD'));
			
			//VERIFICA SI HA SIDO LLENADO ANTES
            $NUM_REGISTRO=$this->db->query("SELECT COUNT(FORM_SECUENCIAL) NUM_REGISTRO 
												FROM FORMULARIO 
												WHERE UPPER(FORM_CEDULA)=UPPER('$FORM_CEDULA')")->row()->NUM_REGISTRO;
			if($NUM_REGISTRO==0){
				//INSERTAR DATOS
				$sqlINSERT="INSERT INTO FORMULARIO (
								FORM_TIPODOCUMENTO,
								FORM_CEDULA,
								FORM_APELLIDOS,
								FORM_NOMBRES,
								FORM_FECHA_NACIMIENTO,
								FORM_CELULAR,
								FORM_CONVENCIONAL,
								FORM_CORREO_PERSONAL,
								FORM_PAIS_NACIMIENTO,
								FORM_PROVINCIA_NACIMIENTO,
								FORM_CANTON_NACIMIENTO,
								FORM_PAIS_RESIDE,
								FORM_PROVINCIA_RESIDE,
								FORM_CANTON_RESIDE,
								FORM_PAIS_SUFRAGIO,
								FORM_PROVINCIA_SUFRAGIO,
								FORM_CANTON_SUFRAGIO,
								FORM_SECTOR_SUFRAGIO,
								FORM_DIRECCION,
								FORM_GENERO,
								FORM_ESTADO_CIVIL,
								FORM_TIPO_SANGRE,
								FORM_ETNIA,
								FORM_PUEBLOS,
								FORM_NIVEL_FORMACION,
								FORM_INGLES,
								FORM_NUM_COMPUS,
								FORM_NUM_CELULARES,
								FORM_NUM_TABLETS,
								FORM_POSEE_INTERNET,
								FORM_NUM_ESTUD_UNIV,
								FORM_NUM_ESTUD_EAC,
								FORM_NUM_ESCCOL,
								FORM_NUM_UNIVERSIDADES,
								FORM_CARGO_DISCAPACITADO,
								FORM_POSEE_DISCAPACIDAD,
								FORM_PORCENTAJE_DISCAP,
								FORM_CARNE_CANDIS,
								FORM_TIPO_DISCAP,
								FORM_POSEE_ENFERMEDAD,
								FORM_ENFERMEDADDES,
								FORM_POSEE_ALERGIA,
								FORM_ALERGIADES,
								FORM_POSEE_MEDICACION,
								FORM_MEDICACIONDES,
								FORM_NUM_FARMACIAS,
								FORM_NUM_HOSPITALES,
								FORM_CERCA_MSP,
								FORM_NUM_FAMILIA,
								FORM_NUM_HIJOS,
								FORM_CANT_INGRESOS,
								FORM_RECIBE_BONO,
								FORM_LABORA,
								FORM_HORARIO_LABORA,
								FORM_USA_INGRESOS,
								FORM_INGRESOSDES,
								FORM_VIVIENDA,
								FORM_CERCA_RETEN,
								FORM_NUM_PATRULLAJES,
								FORM_ALARMA_COMUNITARIA,
								FORM_NUM_ROBOS,
								FORM_FRECUENCIA_ROBOS,
								FORM_LUGAR_ROBOS,
								FORM_LUGAR_ROBODES,
								FORM_NOMBRES_CONTACTO,
								FORM_RELACION_CONTACTO,
								FORM_CELULAR_CONTACTO,
								FORM_COVENCIONAL_CONTACTO,
								FORM_CORREO_CONTACTO,
								FORM_USA_REDES,
								FORM_TIPOS_REDES,
								FORM_LATITUD,
								FORM_LONGITUD,
								FORM_FECHA_INGRESO,
								FORM_ESTADO) 
							VALUES(
								$FORM_TIPODOCUMENTO,
								UPPER('$FORM_CEDULA'),
								UPPER('$FORM_APELLIDOS'),
								UPPER('$FORM_NOMBRES'),
								$FORM_FECHA_NACIMIENTO,
								UPPER('$FORM_CELULAR'),
								UPPER('$FORM_CONVENCIONAL'),
								LOWER('$FORM_CORREO_PERSONAL'),
								UPPER('$FORM_PAIS_NACIMIENTO'),
								UPPER('$FORM_PROVINCIA_NACIMIENTO'),
								UPPER('$FORM_CANTON_NACIMIENTO'),
								UPPER('$FORM_PAIS_RESIDE'),
								UPPER('$FORM_PROVINCIA_RESIDE'),
								UPPER('$FORM_CANTON_RESIDE'),
								UPPER('$FORM_PAIS_SUFRAGIO'),
								UPPER('$FORM_PROVINCIA_SUFRAGIO'),
								UPPER('$FORM_CANTON_SUFRAGIO'),
								UPPER('$FORM_SECTOR_SUFRAGIO'),
								UPPER('$FORM_DIRECCION'),
								UPPER('$FORM_GENERO'),
								UPPER('$FORM_ESTADO_CIVIL'),
								UPPER('$FORM_TIPO_SANGRE'),
								UPPER('$FORM_ETNIA'),
								$FORM_PUEBLOS,
								$FORM_NIVEL_FORMACION,
								$FORM_INGLES,
								$FORM_NUM_COMPUS,
								$FORM_NUM_CELULARES,
								$FORM_NUM_TABLETS,
								$FORM_POSEE_INTERNET,
								$FORM_NUM_ESTUD_UNIV,
								$FORM_NUM_ESTUD_EAC,
								$FORM_NUM_ESCCOL,
								$FORM_NUM_UNIVERSIDADES,
								$FORM_CARGO_DISCAPACITADO,
								$FORM_POSEE_DISCAPACIDAD,
								$FORM_PORCENTAJE_DISCAP,
								UPPER('$FORM_CARNE_CANDIS'),
								$FORM_TIPO_DISCAP,
								$FORM_POSEE_ENFERMEDAD,
								UPPER('$FORM_ENFERMEDADDES'),
								$FORM_POSEE_ALERGIA,
								UPPER('$FORM_ALERGIADES'),
								$FORM_POSEE_MEDICACION,
								UPPER('$FORM_MEDICACIONDES'),
								$FORM_NUM_FARMACIAS,
								$FORM_NUM_HOSPITALES,
								$FORM_CERCA_MSP,
								$FORM_NUM_FAMILIA,
								$FORM_NUM_HIJOS,
								$FORM_CANT_INGRESOS,
								$FORM_RECIBE_BONO,
								$FORM_LABORA,
								UPPER('$FORM_HORARIO_LABORA'),
								$FORM_USA_INGRESOS,
								UPPER('$FORM_INGRESOSDES'),
								$FORM_VIVIENDA,
								$FORM_CERCA_RETEN,
								$FORM_NUM_PATRULLAJES,
								$FORM_ALARMA_COMUNITARIA,
								$FORM_NUM_ROBOS,
								$FORM_FRECUENCIA_ROBOS,
								$FORM_LUGAR_ROBOS,
								UPPER('$FORM_LUGAR_ROBODES'),
								UPPER('$FORM_NOMBRES_CONTACTO'),
								$FORM_RELACION_CONTACTO,
								UPPER('$FORM_CELULAR_CONTACTO'),
								UPPER('$FORM_COVENCIONAL_CONTACTO'),
								LOWER('$FORM_CORREO_CONTACTO'),
								$FORM_USA_REDES,
								'$FORM_TIPOS_REDES',
								'$FORM_LATITUD',
								'$FORM_LONGITUD',
								$FORM_FECHA_INGRESO,
								0)";
					$this->db->query($sqlINSERT);
					//print_r($sqlINSERT);
					
					$FORM_SECUENCIAL=$this->db->query("select max(FORM_SECUENCIAL) SECUENCIAL from FORMULARIO")->row()->SECUENCIAL;
					$correoFuncion=$this->mailConfirmacion($FORM_CEDULA);
					$mensaje="FORMULARIO: ".$FORM_CEDULA.", ingresado con éxito\n\nRevisa tu bandeja de entrada o correo no deseado (SPAM) ".$correoFuncion;
			}else{				
				//ACTUALIZACION DE DATOS
				$sqlUPDATEFORM="UPDATE FORMULARIO SET
												FORM_TIPODOCUMENTO=$FORM_TIPODOCUMENTO,
												FORM_CEDULA=UPPER('$FORM_CEDULA'),
												FORM_APELLIDOS=UPPER('$FORM_APELLIDOS'),
												FORM_NOMBRES=UPPER('$FORM_NOMBRES'),
												FORM_FECHA_NACIMIENTO=$FORM_FECHA_NACIMIENTO,
												FORM_CELULAR=UPPER('$FORM_CELULAR'),
												FORM_CONVENCIONAL=UPPER('$FORM_CONVENCIONAL'),
												FORM_CORREO_PERSONAL=LOWER('$FORM_CORREO_PERSONAL'),
												FORM_PAIS_NACIMIENTO=UPPER('$FORM_PAIS_NACIMIENTO'),
												FORM_PROVINCIA_NACIMIENTO=UPPER('$FORM_PROVINCIA_NACIMIENTO'),
												FORM_CANTON_NACIMIENTO=UPPER('$FORM_CANTON_NACIMIENTO'),
												FORM_PAIS_RESIDE=UPPER('$FORM_PAIS_RESIDE'),
												FORM_PROVINCIA_RESIDE=UPPER('$FORM_PROVINCIA_RESIDE'),
												FORM_CANTON_RESIDE=UPPER('$FORM_CANTON_RESIDE'),
												FORM_PAIS_SUFRAGIO=UPPER('$FORM_PAIS_SUFRAGIO'),
												FORM_PROVINCIA_SUFRAGIO=UPPER('$FORM_PROVINCIA_SUFRAGIO'),
												FORM_CANTON_SUFRAGIO=UPPER('$FORM_CANTON_SUFRAGIO'),
												FORM_SECTOR_SUFRAGIO=UPPER('$FORM_SECTOR_SUFRAGIO'),
												FORM_DIRECCION=UPPER('$FORM_DIRECCION'),
												FORM_GENERO=UPPER('$FORM_GENERO'),
												FORM_ESTADO_CIVIL=UPPER('$FORM_ESTADO_CIVIL'),
												FORM_TIPO_SANGRE=UPPER('$FORM_TIPO_SANGRE'),
												FORM_ETNIA=UPPER('$FORM_ETNIA'),
												FORM_PUEBLOS=$FORM_PUEBLOS,
												FORM_NIVEL_FORMACION=$FORM_NIVEL_FORMACION,
												FORM_INGLES=$FORM_INGLES,
												FORM_NUM_COMPUS=$FORM_NUM_COMPUS,
												FORM_NUM_CELULARES=$FORM_NUM_CELULARES,
												FORM_NUM_TABLETS=$FORM_NUM_TABLETS,
												FORM_POSEE_INTERNET=$FORM_POSEE_INTERNET,
												FORM_NUM_ESTUD_UNIV=$FORM_NUM_ESTUD_UNIV,
												FORM_NUM_ESTUD_EAC=$FORM_NUM_ESTUD_EAC,
												FORM_NUM_ESCCOL=$FORM_NUM_ESCCOL,
												FORM_NUM_UNIVERSIDADES=$FORM_NUM_UNIVERSIDADES,
												FORM_CARGO_DISCAPACITADO=$FORM_CARGO_DISCAPACITADO,
												FORM_POSEE_DISCAPACIDAD=$FORM_POSEE_DISCAPACIDAD,
												FORM_PORCENTAJE_DISCAP=$FORM_PORCENTAJE_DISCAP,
												FORM_CARNE_CANDIS=UPPER('$FORM_CARNE_CANDIS'),
												FORM_TIPO_DISCAP=$FORM_TIPO_DISCAP,
												FORM_POSEE_ENFERMEDAD=$FORM_POSEE_ENFERMEDAD,
												FORM_ENFERMEDADDES=UPPER('$FORM_ENFERMEDADDES'),
												FORM_POSEE_ALERGIA=$FORM_POSEE_ALERGIA,
												FORM_ALERGIADES=UPPER('$FORM_ALERGIADES'),
												FORM_POSEE_MEDICACION=$FORM_POSEE_MEDICACION,
												FORM_MEDICACIONDES=UPPER('$FORM_MEDICACIONDES'),
												FORM_NUM_FARMACIAS=$FORM_NUM_FARMACIAS,
												FORM_NUM_HOSPITALES=$FORM_NUM_HOSPITALES,
												FORM_CERCA_MSP=$FORM_CERCA_MSP,
												FORM_NUM_FAMILIA=$FORM_NUM_FAMILIA,
												FORM_NUM_HIJOS=$FORM_NUM_HIJOS,
												FORM_CANT_INGRESOS=$FORM_CANT_INGRESOS,
												FORM_RECIBE_BONO=$FORM_RECIBE_BONO,
												FORM_LABORA=$FORM_LABORA,
												FORM_HORARIO_LABORA=UPPER('$FORM_HORARIO_LABORA'),
												FORM_USA_INGRESOS=$FORM_USA_INGRESOS,
												FORM_INGRESOSDES=UPPER('$FORM_INGRESOSDES'),
												FORM_VIVIENDA=$FORM_VIVIENDA,
												FORM_CERCA_RETEN=$FORM_CERCA_RETEN,
												FORM_NUM_PATRULLAJES=$FORM_NUM_PATRULLAJES,
												FORM_ALARMA_COMUNITARIA=$FORM_ALARMA_COMUNITARIA,
												FORM_NUM_ROBOS=$FORM_NUM_ROBOS,
												FORM_FRECUENCIA_ROBOS=$FORM_FRECUENCIA_ROBOS,
												FORM_LUGAR_ROBOS=$FORM_LUGAR_ROBOS,
												FORM_LUGAR_ROBODES=UPPER('$FORM_LUGAR_ROBODES'),
												FORM_NOMBRES_CONTACTO=UPPER('$FORM_NOMBRES_CONTACTO'),
												FORM_RELACION_CONTACTO=$FORM_RELACION_CONTACTO,
												FORM_CELULAR_CONTACTO=UPPER('$FORM_CELULAR_CONTACTO'),
												FORM_COVENCIONAL_CONTACTO=UPPER('$FORM_COVENCIONAL_CONTACTO'),
												FORM_CORREO_CONTACTO=LOWER('$FORM_CORREO_CONTACTO'),
												FORM_USA_REDES=$FORM_USA_REDES,
												FORM_TIPOS_REDES='$FORM_TIPOS_REDES',
												FORM_LATITUD='$FORM_LATITUD',
												FORM_LONGITUD='$FORM_LONGITUD',
												FORM_FECHA_INGRESO=$FORM_FECHA_INGRESO
                 WHERE FORM_CEDULA=UPPER('$FORM_CEDULA')";
				$this->db->query($sqlUPDATEFORM);
				//print_r($sqlUPDATEFORM);
				
				$correoFuncion=$this->mailConfirmacion($FORM_CEDULA);
				$mensaje="FORMULARIO: ".$FORM_CEDULA.", actualizado con éxito\n\nRevisa tu bandeja de entrada o correo no deseado (SPAM) ".$correoFuncion;
			}
			echo json_encode(array("cod"=>1,"numero"=>1,"mensaje"=>$mensaje));
    }	
	
	function mailConfirmacion($CEDULA){
				$SQLESTUDIANTE="SELECT FORM_CORREO_PERSONAL,FORM_NOMBRES,FORM_APELLIDOS
											FROM FORMULARIO 
											WHERE FORM_CEDULA=UPPER('{$CEDULA}')";
				$ESTUDIANTE=$this->db->query($SQLESTUDIANTE)->row();
				if(!empty($ESTUDIANTE)){
					$NOMBRES=$ESTUDIANTE->FORM_NOMBRES." ".$ESTUDIANTE->FORM_APELLIDOS;
					$CORREOPERSONAL=$ESTUDIANTE->FORM_CORREO_PERSONAL;
					
					$mail = new PHPMailer;
					$mail->isSMTP();
					$mail->SMTPDebug = 0;
					$mail->Debugoutput = 'html';
					$mail->Host =@$this->config->item('anfitrion');
					$mail->Port =@$this->config->item('puerto');
					$mail->Username =@$this->config->item('usuario');
					$mail->Password =@$this->config->item('clave');
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = 'ssl';
					$mail->setFrom(@$this->config->item('correoSistema'),utf8_decode(@$this->config->item('usuarioSistema')));
					$mail->addReplyTo(@$this->config->item('correoSistema'),utf8_decode(@$this->config->item('usuarioSistema')));
					//correos
					if(!empty($CORREOPERSONAL) and $CORREOPERSONAL!="--"){
						$mail->addAddress($CORREOPERSONAL);
					}
					
					$subject = utf8_decode('ANÁLISIS EMERGENTES, FORMULARIO INGRESADO');
					$mensaje = "<h3> Estimado/a ".strtoupper(html_entity_decode(($NOMBRES)))."</h3><hr><br><br>"
					   .utf8_decode("Gracias por confiar en nostros, nos preocupamos por su bienestar.
					   <br>
						Hemos recibido tu formulario.
						<br>
						<br>
						Confirmamos el ingreso de tus datos.
						<br>
						<br>
						<br>
						<font color='#F40105'><h1>INGRESO SATISFACTORIO</h1></font>
						<br>
						<br>
						Esta es una notificación automática de nuestro sistema por favor no la responda, 
						no hay un ser humano que procese esta notificación.
						<br>
						<br>
						<a href='https://www.utpl.edu.ec/'><img src='http://localhost:8081/formularioemergentes/imagenes/bannerMail.jpg'/></a>
						");
					   
					$mail->Subject = $subject;
					$mail->msgHTML($mensaje);
					if (!$mail->send()) {
							//return $mail->ErrorInfo;
							return 0;
						} else {
							return 1;
						}
				}else{
					return 0;
				}
}

}
?>