<?php
class Mvarios extends CI_Model {
		
	
//Funcion para eliminar carpetas con su contenido	
	function eliminarDir($carpeta){
		foreach(glob($carpeta . "/*") as $archivos_carpeta)
			{
			echo $archivos_carpeta; 
				if (is_dir($archivos_carpeta)){
					eliminarDir($archivos_carpeta);
				}else{
					unlink($archivos_carpeta);
				}
			} 
		rmdir($carpeta);
		}
		
function VerificarCorreo($direccion){
			$Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
				if(preg_match($Sintaxis,$direccion)){
					return 0;
				}else{
					return 1;
				}
		}		
		
	//combo para obtener paises
    function cmb_pais($LOC_SECUENCIAL = null, $attr = null){
		
        $sql = "select LOC_SECUENCIAL, LOC_DESCRIPCION 
				FROM LOCALIZACION 
				WHERE LOC_NIVEL=1 
				AND LOC_ESTADO=0 
				order by LOC_DESCRIPCION";
        $results = $this->db->query($sql)->result_array();
        $output = array();
        if (count($results) > 0) {
            $output[null] = "País...";
            foreach ($results as $result) {
                $output[$result['LOC_SECUENCIAL']] = utf8_encode($result['LOC_DESCRIPCION']);
            }
            return form_dropdown('pais', $output, $LOC_SECUENCIAL, $attr);
       } else {
            return alerta("No Posee Paises. <input type='hidden' name='pais' value='' />");
        }
    }
	
	//combo para obtener las provincias
	function cmb_provincia($LOC_SECUENCIAL = null, $LOC_PAIS = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_PAIS == null)) {
            $output[null] = "Provincia...";
            return form_dropdown('provincia', $output, $LOC_SECUENCIAL, $attr);
        } else {
            $query = $this->db->query("select LOC_SECUENCIAL, LOC_DESCRIPCION 
										FROM LOCALIZACION 
										where LOC_NIVEL=2 
										AND LOC_ESTADO=0 
										AND LOC_PREDECESOR=$LOC_PAIS
										order by LOC_DESCRIPCION");
            $results = $query->result_array();
            $output = array();
            if ($query->num_rows() > 0) {
                foreach ($results as $result) {
                    $output[null] = "Provincia...";
                    $output[$result['LOC_SECUENCIAL']] = utf8_encode($result['LOC_DESCRIPCION']);
                }
                return form_dropdown('provincia', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Provincias. <input type='hidden' name='provincia' value='' />");
            }
		}
	}
	
	//combo para obtener las ciudades
	function cmb_ciudad($LOC_SECUENCIAL = null, $LOC_PROVINCIA = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_PROVINCIA == null)) {
            $output[null] = "Ciudad..";
            return form_dropdown('ciudad', $output, $LOC_SECUENCIAL, $attr);
        } else {
            $query = $this->db->query("select LOC_SECUENCIAL, LOC_DESCRIPCION 
										FROM LOCALIZACION 
										where LOC_NIVEL=3 
										AND LOC_ESTADO=0 
										AND LOC_PREDECESOR=$LOC_PROVINCIA
										order by LOC_DESCRIPCION");
            $results = $query->result_array();
            $output = array();
            if ($query->num_rows() > 0) {
                foreach ($results as $result) {
                    $output[null] = "Ciudad..";
                    $output[$result['LOC_SECUENCIAL']] = utf8_encode($result['LOC_DESCRIPCION']);
                }
                return form_dropdown('ciudad', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Ciudades. <input type='hidden' name='ciudad' value='' />");
            }
		}
	}
	
	//combo para obtener las sectores
	function cmb_sector($LOC_SECUENCIAL = null, $LOC_CIUDAD = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_CIUDAD == null)) {
            $output[null] = "Sector..";
            return form_dropdown('sector', $output, $LOC_SECUENCIAL, $attr);
        } else {
            $query = $this->db->query("select LOC_SECUENCIAL, LOC_DESCRIPCION 
										FROM LOCALIZACION 
										where LOC_NIVEL=4 
										AND LOC_ESTADO=0 
										AND LOC_PREDECESOR=$LOC_CIUDAD
										order by LOC_DESCRIPCION");
            $results = $query->result_array();
            $output = array();
            if ($query->num_rows() > 0) {
                foreach ($results as $result) {
                    $output[null] = "Sector..";
                    $output[$result['LOC_SECUENCIAL']] = utf8_encode($result['LOC_DESCRIPCION']);
                }
                return form_dropdown('sector', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Sectores. <input type='hidden' name='sector' value='' />");
            }
		}
	}
	
	//función para unir pdf seleccionados en uno
	function unirPDF($arr_files=null,$archivo=null){
		$this->load->library("fpdi_extra");
			$this->fpdi_extra->setFiles($arr_files); /// Aquí concatenamos los archivos, tantos como sean necesarios.
			$this->fpdi_extra->concat();
			$this->fpdi_extra->Output( $archivo, "F");
		$mensaje = "<iframe src='{$archivo}' width='1049' height='644'></iframe>";
		echo json_encode(array("mensaje" => $mensaje));
	}
	
	//función para comprimir documentos en zip
	function archivosZIP($claveAcceso=null,$TIPO=0,$COMPROBANTE=null,$FECHA=null){		
		 $direccion=getTipo($TIPO).$COMPROBANTE."/".$FECHA."/";
		 //Empaquetar en ZIP comprobantes
			$zip = new ZipArchive(); 
			$filename = 'tmp/'.$claveAcceso.'.zip';
			//copia xml
			$xmlc=$direccion.$claveAcceso.".xml";
			$xml="comprobante/".$claveAcceso.".xml";
			if (!copy($xmlc, $xml)) {
				return "Error al copiar $fichero...\n";
			}	
			//compia pdf
			$pdfc=$direccion.$claveAcceso.".pdf";				
			$pdf="comprobante/".$claveAcceso.".pdf";
			if (!copy($pdfc, $pdf)) {
				return "Error al copiar $fichero...\n";
			}			
			
			if($zip->open($filename,ZIPARCHIVE::CREATE)===true) {
				$zip->addFile($xml);
				$zip->addFile($pdf);
				$zip->close();
				return $filename;
			}else {
				return 'ERROR...'.$filename;
			}
	}
	
	//Elimina Contenido directorio
	function eliminaContenidoDir($dir=null){
			$result = false;
		if ($handle = opendir("$dir")){
			$result = true;
			while ((($file=readdir($handle))!==false) && ($result)){
				if ($file!='.' && $file!='..'){
					if (is_dir("$dir/$file")){
						$result = $this->eliminaContenidoDir("$dir/$file");
					} else {
						$result = unlink("$dir/$file");
					}
				}
			}
			closedir($handle);
		}
		return $result;
	}
			
	
	function getGenero(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_GENERO ,(CASE FORM_GENERO 
                 WHEN 'M' THEN 'Masculino'
				 WHEN 'F' THEN 'Femenino'
                 END) FORM_GENERODES FROM FORMULARIO 
				 WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_GENERODES,utf8_encode($result->FORM_GENERODES));
		}
		return select("cmbgenero[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getTipoSangre(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_TIPO_SANGRE, 
						(CASE FORM_TIPO_SANGRE
						WHEN 'AP' THEN 'A+'
						WHEN 'AN' THEN 'A-'
						WHEN 'BP' THEN 'B+'
						WHEN 'BN' THEN 'B-'
						WHEN 'OP' THEN 'O+'
						WHEN 'ON' THEN 'O-'
						WHEN 'ABP' THEN 'AB+'
						WHEN 'ABN' THEN 'AB-'
						END) FORM_TIPO_SANGREDES FROM FORMULARIO 
						WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_TIPO_SANGREDES,utf8_encode($result->FORM_TIPO_SANGREDES));
		}
		return select("cmbtiposangre[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getCargoDiscapacitado(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_CARGO_DISCAPACITADO, (CASE FORM_CARGO_DISCAPACITADO
						WHEN 0 THEN 'NO'
						WHEN 1 THEN 'SI'
						END) FORM_CARGO_DISCAPACITADODES FROM FORMULARIO 
												WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_CARGO_DISCAPACITADODES,utf8_encode($result->FORM_CARGO_DISCAPACITADODES));
		}
		return select("cmbcargodiscapacitado[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getDiscapacidad(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_POSEE_DISCAPACIDAD, (CASE FORM_POSEE_DISCAPACIDAD
						WHEN 0 THEN 'NO'
						WHEN 1 THEN 'SI'
						END) FORM_POSEE_DISCAPACIDADDES FROM FORMULARIO 
												WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_POSEE_DISCAPACIDADDES,utf8_encode($result->FORM_POSEE_DISCAPACIDADDES));
		}
		return select("cmbdiscapacitado[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getTipoDiscapacidad(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_TIPO_DISCAP, (CASE FORM_TIPO_DISCAP
					WHEN 0 THEN 'No Aplica'
					WHEN 1 THEN 'Intelectual'
					WHEN 2 THEN 'Física'
					WHEN 3 THEN 'Visual'
					WHEN 4 THEN 'Auditiva'
					WHEN 5 THEN 'Mental'
					WHEN 6 THEN 'Otro'
					END) FORM_TIPO_DISCAPDES FROM FORMULARIO 
					WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_TIPO_DISCAPDES,utf8_encode($result->FORM_TIPO_DISCAPDES));
		}
		return select("cmbtipodiscapacidad[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getEnfermedades(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_POSEE_ENFERMEDAD,(CASE FORM_POSEE_ENFERMEDAD
							WHEN 0 THEN 'NO'
							WHEN 1 THEN 'SI'
							END) FORM_POSEE_ENFERMEDADDES FROM FORMULARIO 
												WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_POSEE_ENFERMEDADDES,utf8_encode($result->FORM_POSEE_ENFERMEDADDES));
		}
		return select("cmbenfermedad[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getAlergias(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_POSEE_ALERGIA,(CASE FORM_POSEE_ALERGIA
						WHEN 0 THEN 'NO'
						WHEN 1 THEN 'SI'
						END) FORM_POSEE_ALERGIADES FROM FORMULARIO 
												WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_POSEE_ALERGIADES,utf8_encode($result->FORM_POSEE_ALERGIADES));
		}
		return select("cmbalergias[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getMedicacion(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_POSEE_MEDICACION,(CASE FORM_POSEE_MEDICACION
							WHEN 0 THEN 'NO'
							WHEN 1 THEN 'SI'
							END) FORM_POSEE_MEDICACIONDES FROM FORMULARIO 
												WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_POSEE_MEDICACIONDES,utf8_encode($result->FORM_POSEE_MEDICACIONDES));
		}
		return select("cmbmedicacion[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getCercaMSP(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_CERCA_MSP,(CASE FORM_CERCA_MSP
						WHEN 0 THEN 'NO'
						WHEN 1 THEN 'SI'
						END) FORM_CERCA_MSPDES FROM FORMULARIO 
												WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_CERCA_MSPDES,utf8_encode($result->FORM_CERCA_MSPDES));
		}
		return select("cmbcercamsp[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getEstadoCivil(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_ESTADO_CIVIL,(CASE FORM_ESTADO_CIVIL
								WHEN 'S' THEN 'Soltero/a'
								WHEN 'C' THEN 'Casado/a'
								WHEN 'D' THEN 'Divorciado/a'
								WHEN 'U' THEN 'Unión Libre'
								WHEN 'V' THEN 'Viudo/a'
								END) FORM_ESTADO_CIVILDES
								FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_ESTADO_CIVILDES,utf8_encode($result->FORM_ESTADO_CIVILDES));
		}
		return select("cmbestadocivil[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getNivelFormacion(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_NIVEL_FORMACION,(CASE FORM_NIVEL_FORMACION
														WHEN 1 THEN 'Centro alfabetización'
														WHEN 2 THEN 'Jardín de infantes'
														WHEN 3 THEN 'Primaria'
														WHEN 4 THEN 'Educación básica'
														WHEN 5 THEN 'Secundaria'
														WHEN 6 THEN 'Bachillerato'
														WHEN 7 THEN 'Educación media'
														WHEN 8 THEN 'Estudiante Pregrado'
														WHEN 9 THEN 'Estudiante Postgrado'
														WHEN 10 THEN 'Superior universitaria'
														WHEN 11 THEN 'Superior no universitaria'
														WHEN 12 THEN 'Posgrado'
														WHEN 13 THEN 'PHD'
														WHEN 14 THEN 'No Aplica'
														END) FORM_NIVEL_FORMACIONDES
														FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_NIVEL_FORMACIONDES,utf8_encode($result->FORM_NIVEL_FORMACIONDES));
		}
		return select("cmbnivelformacion[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getIngles(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_INGLES,(CASE FORM_INGLES
											WHEN 1 THEN 'A1'
											WHEN 2 THEN 'A2'
											WHEN 3 THEN 'B1'
											WHEN 4 THEN 'B2'
											WHEN 5 THEN 'TOFEL'
											WHEN 6 THEN 'Ninguna'
											END) FORM_INGLESDES
											FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_INGLESDES,utf8_encode($result->FORM_INGLESDES));
		}
		return select("cmbingles[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getInternet(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_POSEE_INTERNET,(CASE FORM_POSEE_INTERNET
							WHEN 0 THEN 'NO'
							WHEN 1 THEN 'SI'
							END) FORM_POSEE_INTERNETDES
							FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_POSEE_INTERNETDES,utf8_encode($result->FORM_POSEE_INTERNETDES));
		}
		return select("cmbinternet[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getReten(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_CERCA_RETEN,(CASE FORM_CERCA_RETEN
							WHEN 0 THEN 'NO'
							WHEN 1 THEN 'SI'
							END) FORM_CERCA_RETENDES
							FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_CERCA_RETENDES,utf8_encode($result->FORM_CERCA_RETENDES));
		}
		return select("cmbreten[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getAlarma(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_ALARMA_COMUNITARIA,(CASE FORM_ALARMA_COMUNITARIA
								WHEN 0 THEN 'NO'
								WHEN 1 THEN 'SI'
								END) FORM_ALARMA_COMUNITARIADES
								FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_ALARMA_COMUNITARIADES,utf8_encode($result->FORM_ALARMA_COMUNITARIADES));
		}
		return select("cmbalarma[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getFrecuenciaRobo(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_FRECUENCIA_ROBOS,(CASE FORM_FRECUENCIA_ROBOS
								WHEN 1 THEN '06:00 A 09:00'
								WHEN 2 THEN '12:00 A 14:00'
								WHEN 3 THEN '17:00 A 21:00'
								WHEN 4 THEN 'MADRUGADA'
								WHEN 5 THEN 'HORARIOS NO LABORALES'
								WHEN 6 THEN 'N/A'
								END) FORM_FRECUENCIA_ROBOSDES
							FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_FRECUENCIA_ROBOSDES,utf8_encode($result->FORM_FRECUENCIA_ROBOSDES));
		}
		return select("cmbfrecuenciarobo[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getLugarRobo(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_LUGAR_ROBOS,(CASE FORM_LUGAR_ROBOS
							WHEN 1 THEN 'PARADAS DE BUSES'
							WHEN 2 THEN 'BUSES'
							WHEN 3 THEN 'CALLEJONES'
							WHEN 4 THEN 'CASAS'
							WHEN 5 THEN 'CALLES PRINCIPALES'
							WHEN 6 THEN 'CALLES TRANSVERSALES'
							WHEN 7 THEN FORM_LUGAR_ROBODES
							WHEN 8 THEN 'No Aplica'
							END) FORM_LUGAR_ROBOSDES
				FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_LUGAR_ROBOSDES,utf8_encode($result->FORM_LUGAR_ROBOSDES));
		}
		return select("cmblugarrobo[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getbono(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_RECIBE_BONO,(CASE FORM_RECIBE_BONO
																WHEN 0 THEN 'NO'
																WHEN 1 THEN 'SI'
																END) FORM_RECIBE_BONODES
													FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_RECIBE_BONODES,utf8_encode($result->FORM_RECIBE_BONODES));
		}
		return select("cmbbono[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getlabora(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_LABORA,(CASE FORM_LABORA
														WHEN 0 THEN 'NO'
														WHEN 1 THEN 'SI'
														END) FORM_LABORADES
													FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_LABORADES,utf8_encode($result->FORM_LABORADES));
		}
		return select("cmblabora[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getIngresos(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_USA_INGRESOS,(CASE FORM_USA_INGRESOS
													WHEN 1 THEN 'Financiar sus estudios'
													WHEN 2 THEN 'Mantener su hogar'
													WHEN 3 THEN 'Gastos personales no esenciales'
													WHEN 4 THEN 'Financiar sus estudios y mantener su hogar'
													WHEN 5 THEN FORM_INGRESOSDES
													WHEN 6 THEN 'No aplica'
													ELSE
													'--'
													END) FORM_USA_INGRESOSDES
													FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_USA_INGRESOSDES,utf8_encode($result->FORM_USA_INGRESOSDES));
		}
		return select("cmbingresos[]","required",$out,"multiple='multiple'",-2);
	}
	
	function getVivienda(){
		$out = null;
		$sql = "SELECT DISTINCT FORM_VIVIENDA,(CASE FORM_VIVIENDA
												WHEN 1 THEN 'Propia'
												WHEN 2 THEN 'Arrienda'
												WHEN 3 THEN 'Antecresis'
												WHEN 4 THEN 'De Familiares'
												WHEN 5 THEN 'Cuida'
												WHEN 6 THEN 'Compratida'
												WHEN 7 THEN 'Otro'
												END) FORM_VIVIENDADES
													FROM FORMULARIO WHERE FORM_ESTADO=0";
        $results = $this->db->query($sql)->result();
		foreach($results as $result){
			$out .= option(null,$result->FORM_VIVIENDADES,utf8_encode($result->FORM_VIVIENDADES));
		}
		return select("cmbvivienda[]","required",$out,"multiple='multiple'",-2);
	}

}?>
