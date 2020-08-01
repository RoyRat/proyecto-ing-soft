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
    function cmb_paisnacionalidad($LOC_SECUENCIAL = null, $attr = null){
		
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
			$output['OT'] = utf8_encode('Otro Pais');
            return form_dropdown('paisnacionalidad', $output, $LOC_SECUENCIAL, $attr);
       } else {
            return alerta("No Posee Paises. <input type='hidden' name='paisnacionalidad' value='' />");
        }
    }
	
	//combo para obtener las provincias
	function cmb_provincianacionalidad($LOC_SECUENCIAL = null, $LOC_PAIS = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_PAIS == null)) {
            $output[null] = "Provincia...";
            return form_dropdown('provincianacionalidad', $output, $LOC_SECUENCIAL, $attr);
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
                return form_dropdown('provincianacionalidad', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Provincias. <input type='hidden' name='provincianacionalidad' value='' />");
            }
		}
	}
	
	//combo para obtener las ciudades
	function cmb_ciudadnacionalidad($LOC_SECUENCIAL = null, $LOC_PROVINCIA = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_PROVINCIA == null)) {
            $output[null] = "Ciudad..";
            return form_dropdown('ciudadnacionalidad', $output, $LOC_SECUENCIAL, $attr);
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
                return form_dropdown('ciudadnacionalidad', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Ciudades. <input type='hidden' name='ciudadnacionalidad' value='' />");
            }
		}
	}
	
	//combo para obtener las sectores
	function cmb_sectornacionalidad($LOC_SECUENCIAL = null, $LOC_CIUDAD = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_CIUDAD == null)) {
            $output[null] = "Sector..";
            return form_dropdown('sectornacionalidad', $output, $LOC_SECUENCIAL, $attr);
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
                return form_dropdown('sectornacionalidad', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Sectores. <input type='hidden' name='sectornacionalidad' value='' />");
            }
		}
	}
	
	//RESIDENCIA
	//combo para obtener paises
    function cmb_paisreside($LOC_SECUENCIAL = null, $attr = null){
		
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
			$output['OT'] = utf8_encode('Otro Pais');
            return form_dropdown('paisreside', $output, $LOC_SECUENCIAL, $attr);
       } else {
            return alerta("No Posee Paises. <input type='hidden' name='paisreside' value='' />");
        }
    }
	
	//combo para obtener las provincias
	function cmb_provinciareside($LOC_SECUENCIAL = null, $LOC_PAIS = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_PAIS == null)) {
            $output[null] = "Provincia...";
            return form_dropdown('provinciareside', $output, $LOC_SECUENCIAL, $attr);
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
                return form_dropdown('provinciareside', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Provincias. <input type='hidden' name='provinciareside' value='' />");
            }
		}
	}
	
	//combo para obtener las ciudades
	function cmb_ciudadreside($LOC_SECUENCIAL = null, $LOC_PROVINCIA = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_PROVINCIA == null)) {
            $output[null] = "Ciudad..";
            return form_dropdown('ciudadreside', $output, $LOC_SECUENCIAL, $attr);
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
                return form_dropdown('ciudadreside', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Ciudades. <input type='hidden' name='ciudadreside' value='' />");
            }
		}
	}
	
	//combo para obtener las sectores
	function cmb_sectorreside($LOC_SECUENCIAL = null, $LOC_CIUDAD = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_CIUDAD == null)) {
            $output[null] = "Sector..";
            return form_dropdown('sectorreside', $output, $LOC_SECUENCIAL, $attr);
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
                return form_dropdown('sectorreside', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Sectores. <input type='hidden' name='sectorreside' value='' />");
            }
		}
	}
	
	//SUFRAGIO
	//combo para obtener paises
    function cmb_paissufragio($LOC_SECUENCIAL = null, $attr = null){
		
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
			$output['OT'] = utf8_encode('Otro Pais');
            return form_dropdown('paissufragio', $output, $LOC_SECUENCIAL, $attr);
       } else {
            return alerta("No Posee Paises. <input type='hidden' name='paissufragio' value='' />");
        }
    }
	
	//combo para obtener las provincias
	function cmb_provinciasufragio($LOC_SECUENCIAL = null, $LOC_PAIS = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_PAIS == null)) {
            $output[null] = "Provincia...";
            return form_dropdown('provinciasufragio', $output, $LOC_SECUENCIAL, $attr);
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
                return form_dropdown('provinciasufragio', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Provincias. <input type='hidden' name='provinciasufragio' value='' />");
            }
		}
	}
	
	//combo para obtener las ciudades
	function cmb_ciudadsufragio($LOC_SECUENCIAL = null, $LOC_PROVINCIA = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_PROVINCIA == null)) {
            $output[null] = "Ciudad..";
            return form_dropdown('ciudadsufragio', $output, $LOC_SECUENCIAL, $attr);
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
                return form_dropdown('ciudadsufragio', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Ciudades. <input type='hidden' name='ciudadsufragio' value='' />");
            }
		}
	}
	
	//combo para obtener las sectores
	function cmb_sectorsufragio($LOC_SECUENCIAL = null, $LOC_CIUDAD = null,$attr = null){
        if (($LOC_SECUENCIAL == null) and ($LOC_CIUDAD == null)) {
            $output[null] = "Sector..";
            return form_dropdown('sectorsufragio', $output, $LOC_SECUENCIAL, $attr);
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
                return form_dropdown('sectorsufragio', $output, $LOC_SECUENCIAL, $attr);
            } else {
                return alerta("No Posee Sectores. <input type='hidden' name='sectorsufragio' value='' />");
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
	
	
}
?>
