<?php
class Mreporte extends CI_Model {
	
	//Consulta para Salud
   function getSalud(){
        $datos = new stdClass();
        $consulta=$_POST['_search'];
		$SD_FECHA_INGRESOINI=$this->input->post('SD_FECHA_INGRESOINI');
		$SD_FECHA_INGRESOFIN=$this->input->post('SD_FECHA_INGRESOFIN');
		$cmbgenero=$this->input->post('cmbgenero');
		$cmbtiposangre=$this->input->post('cmbtiposangre');
		$cmbcargodiscapacitado=$this->input->post('cmbcargodiscapacitado');
		$cmbdiscapacitado=$this->input->post('cmbdiscapacitado');
		$cmbtipodiscapacidad=$this->input->post('cmbtipodiscapacidad');
		$cmbenfermedad=$this->input->post('cmbenfermedad');
		$cmbalergias=$this->input->post('cmbalergias');
		$cmbmedicacion=$this->input->post('cmbmedicacion');
		$cmbcercamsp=$this->input->post('cmbcercamsp');
		$SD_NUM_FARMACIAS=$this->input->post('SD_NUM_FARMACIAS');
		$SD_NUM_HOSPITALES=$this->input->post('SD_NUM_HOSPITALES');
		
		$datos->econdicion =" SD_ESTADO<>1";
		
		//If para fechas de SD_FECHA_INGRESOINI y SD_FECHA_INGRESOFIN	
		if (!empty($SD_FECHA_INGRESOINI) and !empty($SD_FECHA_INGRESOFIN)){
		  $datos->econdicion .=" AND SD_FECHA_INGRESO between 
									STR_TO_DATE('$SD_FECHA_INGRESOINI 00:00:00', '%d-%m-%Y %H:%i:%s')
										AND 
									STR_TO_DATE('$SD_FECHA_INGRESOFIN 23:59:59', '%d-%m-%Y %H:%i:%s')";              
		  }
		  
		//cmbgenero
		if($cmbgenero!='null' and !empty($cmbgenero)){
				$datos->econdicion .= " AND SD_GENERO in (";
			foreach ($cmbgenero as $genero){
				$datos->econdicion .= "'".pharseAmp($genero)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}
			
		//cmbtiposangre
		if($cmbtiposangre!='null' and !empty($cmbtiposangre)){
				$datos->econdicion .= " AND SD_TIPO_SANGRE in (";
			foreach ($cmbtiposangre as $tiposangre){
				$datos->econdicion .= "'".pharseAmp($tiposangre)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}	
		
		//cmbcargodiscapacitado
		if($cmbcargodiscapacitado!='null' and !empty($cmbcargodiscapacitado)){
				$datos->econdicion .= " AND SD_CARGO_DISCAPACITADO in (";
			foreach ($cmbcargodiscapacitado as $cargodiscapacitado){
				$datos->econdicion .= "'".pharseAmp($cargodiscapacitado)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}
			
		//cmbdiscapacitado
		if($cmbdiscapacitado!='null' and !empty($cmbdiscapacitado)){
				$datos->econdicion .= " AND SD_POSEE_DISCPACIDAD in (";
			foreach ($cmbdiscapacitado as $discapacitado){
				$datos->econdicion .= "'".pharseAmp($discapacitado)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}
			
		//cmbtipodiscapacidad
		if($cmbtipodiscapacidad!='null' and !empty($cmbtipodiscapacidad)){
				$datos->econdicion .= " AND SD_TIPO_DISCAP in (";
			foreach ($cmbtipodiscapacidad as $tipodiscapacidad){
				$datos->econdicion .= "'".pharseAmp($tipodiscapacidad)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}

		//cmbenfermedad
		if($cmbenfermedad!='null' and !empty($cmbenfermedad)){
				$datos->econdicion .= " AND SD_POSEE_ENFERMEDAD in (";
			foreach ($cmbenfermedad as $enfermedad){
				$datos->econdicion .= "'".pharseAmp($enfermedad)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}

		//cmbalergias
		if($cmbalergias!='null' and !empty($cmbalergias)){
				$datos->econdicion .= " AND SD_POSEE_ALERGIA in (";
			foreach ($cmbalergias as $alergias){
				$datos->econdicion .= "'".pharseAmp($alergias)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}

		//cmbmedicacion
		if($cmbmedicacion!='null' and !empty($cmbmedicacion)){
				$datos->econdicion .= " AND SD_POSEE_ALERGIA in (";
			foreach ($cmbmedicacion as $medicacion){
				$datos->econdicion .= "'".pharseAmp($medicacion)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}
			
		//cmbcercamsp
		if($cmbcercamsp!='null' and !empty($cmbcercamsp)){
				$datos->econdicion .= " AND SD_CERCA_MSP in (";
			foreach ($cmbcercamsp as $cercamsp){
				$datos->econdicion .= "'".pharseAmp($cercamsp)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}
			
		//SD_NUM_FARMACIAS
		if (!empty($SD_NUM_FARMACIAS) and ($SD_FECHA_INGRESOFIN!=0)){
		  $datos->econdicion .=" AND SD_NUM_FARMACIAS=$SD_NUM_FARMACIAS";              
		  }
		  
		 //SD_NUM_HOSPITALES
		if (!empty($SD_NUM_HOSPITALES) and ($SD_NUM_HOSPITALES!=0)){
		  $datos->econdicion .=" AND SD_NUM_HOSPITALES=$SD_NUM_HOSPITALES";              
		  } 
		
		
              $datos->campoId = "SD_SECUENCIAL";
			  $datos->camposelect = array("SD_SECUENCIAL",
											"SD_TIPODOCUMENTO",
											"SD_CEDULA",
											"SD_APELLIDOS",
											"SD_NOMBRES",
											"SD_FECHA_NACIMIENTO",
											"SD_CELULAR",
											"SD_CONVENCIONAL",
											"SD_CORREO",
											"SD_PAIS_NACIMIENTO",
											"SD_PROVINCIA_NACIMIENTO",
											"SD_CANTON_NACIMIENTO",
											"SD_PAIS_RESIDE",
											"SD_PROVINCIA_RESIDE",
											"SD_CANTON_RESIDE",
											"SD_PAIS_SUFRAGIO",
											"SD_PROVINCIA_SUFRAGIO",
											"SD_CANTON_SUFRAGIO",
											"SD_SECTOR_SUFRAGIO",
											"SD_GENERO",
											"SD_ESTADO_CIVIL",
											"SD_TIPO_SANGRE",
											"SD_CARGO_DISCAPACITADO",
											"SD_POSEE_DISCPACIDAD",
											"SD_PORCENTAJE_DISCAP",
											"SD_CARNE_CONADIS",
											"SD_TIPO_DISCAP",
											"SD_POSEE_ENFERMEDAD",
											"SD_ENFERMEDADDES",
											"SD_POSEE_ALERGIA",
											"SD_ALERGIADES",
											"SD_POSEE_MEDICACION",
											"SD_MEDICACIONDES",
											"SD_NUM_FARMACIAS",
											"SD_NUM_HOSPITALES",
											"SD_CERCA_MSP",
											"SD_FECHA_INGRESO",
											"SD_ESTADO");
			  $datos->campos = array("SD_SECUENCIAL",
										   "SD_TIPODOCUMENTO",
											"SD_CEDULA",
											"SD_APELLIDOS",
											"SD_NOMBRES",
											"SD_FECHA_NACIMIENTO",
											"SD_CELULAR",
											"SD_CONVENCIONAL",
											"SD_CORREO",
											"SD_PAIS_NACIMIENTO",
											"SD_PROVINCIA_NACIMIENTO",
											"SD_CANTON_NACIMIENTO",
											"SD_PAIS_RESIDE",
											"SD_PROVINCIA_RESIDE",
											"SD_CANTON_RESIDE",
											"SD_PAIS_SUFRAGIO",
											"SD_PROVINCIA_SUFRAGIO",
											"SD_CANTON_SUFRAGIO",
											"SD_SECTOR_SUFRAGIO",
											"SD_GENERO",
											"SD_ESTADO_CIVIL",
											"SD_TIPO_SANGRE",
											"SD_CARGO_DISCAPACITADO",
											"SD_POSEE_DISCPACIDAD",
											"SD_PORCENTAJE_DISCAP",
											"SD_CARNE_CONADIS",
											"SD_TIPO_DISCAP",
											"SD_POSEE_ENFERMEDAD",
											"SD_ENFERMEDADDES",
											"SD_POSEE_ALERGIA",
											"SD_ALERGIADES",
											"SD_POSEE_MEDICACION",
											"SD_MEDICACIONDES",
											"SD_NUM_FARMACIAS",
											"SD_NUM_HOSPITALES",
											"SD_CERCA_MSP",
											"SD_FECHA_INGRESO",
											"SD_ESTADO");
			  $datos->tabla="VW_SALUD";
              $datos->debug = false;
               return $this->jqtabla->finalizarTabla($this->jqtabla->getTabla($datos), $datos);
   }
	
	
//Consulta para Educacion
   function getEducacion(){
        $datos = new stdClass();
        $consulta=$_POST['_search'];
		$ED_FECHA_INGRESOINI=$this->input->post('ED_FECHA_INGRESOINI');
		$ED_FECHA_INGRESOFIN=$this->input->post('ED_FECHA_INGRESOFIN');
		$cmbgenero=$this->input->post('cmbgenero');
		
		$cmbtiposangre=$this->input->post('cmbtiposangre');
		$cmbcargodiscapacitado=$this->input->post('cmbcargodiscapacitado');
		$cmbdiscapacitado=$this->input->post('cmbdiscapacitado');
		$cmbtipodiscapacidad=$this->input->post('cmbtipodiscapacidad');
		$cmbenfermedad=$this->input->post('cmbenfermedad');
		$cmbalergias=$this->input->post('cmbalergias');
		$cmbmedicacion=$this->input->post('cmbmedicacion');
		$cmbcercamsp=$this->input->post('cmbcercamsp');
		$SD_NUM_FARMACIAS=$this->input->post('SD_NUM_FARMACIAS');
		$SD_NUM_HOSPITALES=$this->input->post('SD_NUM_HOSPITALES');
		
		$datos->econdicion =" SD_ESTADO<>1";
		
		//If para fechas de ED_FECHA_INGRESOINI y ED_FECHA_INGRESOFIN	
		if (!empty($ED_FECHA_INGRESOINI) and !empty($ED_FECHA_INGRESOFIN)){
		  $datos->econdicion .=" AND ED_FECHA_INGRESO between 
									STR_TO_DATE('$ED_FECHA_INGRESOINI 00:00:00', '%d-%m-%Y %H:%i:%s')
										AND 
									STR_TO_DATE('$ED_FECHA_INGRESOFIN 23:59:59', '%d-%m-%Y %H:%i:%s')";              
		  }
		  
		//cmbgenero
		if($cmbgenero!='null' and !empty($cmbgenero)){
				$datos->econdicion .= " AND ED_GENERO in (";
			foreach ($cmbgenero as $genero){
				$datos->econdicion .= "'".pharseAmp($genero)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}
			
			
			
		//cmbtiposangre
		if($cmbtiposangre!='null' and !empty($cmbtiposangre)){
				$datos->econdicion .= " AND SD_TIPO_SANGRE in (";
			foreach ($cmbtiposangre as $tiposangre){
				$datos->econdicion .= "'".pharseAmp($tiposangre)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}	
		
		//cmbcargodiscapacitado
		if($cmbcargodiscapacitado!='null' and !empty($cmbcargodiscapacitado)){
				$datos->econdicion .= " AND SD_CARGO_DISCAPACITADO in (";
			foreach ($cmbcargodiscapacitado as $cargodiscapacitado){
				$datos->econdicion .= "'".pharseAmp($cargodiscapacitado)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}
			
		//cmbdiscapacitado
		if($cmbdiscapacitado!='null' and !empty($cmbdiscapacitado)){
				$datos->econdicion .= " AND SD_POSEE_DISCPACIDAD in (";
			foreach ($cmbdiscapacitado as $discapacitado){
				$datos->econdicion .= "'".pharseAmp($discapacitado)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}
			
		//cmbtipodiscapacidad
		if($cmbtipodiscapacidad!='null' and !empty($cmbtipodiscapacidad)){
				$datos->econdicion .= " AND SD_TIPO_DISCAP in (";
			foreach ($cmbtipodiscapacidad as $tipodiscapacidad){
				$datos->econdicion .= "'".pharseAmp($tipodiscapacidad)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}

		//cmbenfermedad
		if($cmbenfermedad!='null' and !empty($cmbenfermedad)){
				$datos->econdicion .= " AND SD_POSEE_ENFERMEDAD in (";
			foreach ($cmbenfermedad as $enfermedad){
				$datos->econdicion .= "'".pharseAmp($enfermedad)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}

		//cmbalergias
		if($cmbalergias!='null' and !empty($cmbalergias)){
				$datos->econdicion .= " AND SD_POSEE_ALERGIA in (";
			foreach ($cmbalergias as $alergias){
				$datos->econdicion .= "'".pharseAmp($alergias)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}

		//cmbmedicacion
		if($cmbmedicacion!='null' and !empty($cmbmedicacion)){
				$datos->econdicion .= " AND SD_POSEE_ALERGIA in (";
			foreach ($cmbmedicacion as $medicacion){
				$datos->econdicion .= "'".pharseAmp($medicacion)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}
			
		//cmbcercamsp
		if($cmbcercamsp!='null' and !empty($cmbcercamsp)){
				$datos->econdicion .= " AND SD_CERCA_MSP in (";
			foreach ($cmbcercamsp as $cercamsp){
				$datos->econdicion .= "'".pharseAmp($cercamsp)."',";
			}
				$datos->econdicion = substr($datos->econdicion,0,-1);
				$datos->econdicion .=")";
			}
			
		//SD_NUM_FARMACIAS
		if (!empty($SD_NUM_FARMACIAS) and ($SD_FECHA_INGRESOFIN!=0)){
		  $datos->econdicion .=" AND SD_NUM_FARMACIAS=$SD_NUM_FARMACIAS";              
		  }
		  
		 //SD_NUM_HOSPITALES
		if (!empty($SD_NUM_HOSPITALES) and ($SD_NUM_HOSPITALES!=0)){
		  $datos->econdicion .=" AND SD_NUM_HOSPITALES=$SD_NUM_HOSPITALES";              
		  } 
		
		
              $datos->campoId = "ED_SECUENCIAL";
			  $datos->camposelect = array("ED_SECUENCIAL",
											"ED_TIPODOCUMENTO",
											"ED_CEDULA",
											"ED_APELLIDOS",
											"ED_NOMBRES",
											"ED_FECHA_NACIMIENTO",
											"ED_CELULAR",
											"ED_CONVENCIONAL",
											"ED_CORREO",
											"ED_PAIS_NACIMIENTO",
											"ED_PROVINCIA_NACIMIENTO",
											"ED_CANTON_NACIMIENTO",
											"ED_PAIS_RESIDE",
											"ED_PROVINCIA_RESIDE",
											"ED_CANTON_RESIDE",
											"ED_PAIS_SUFRAGIO",
											"ED_PROVINCIA_SUFRAGIO",
											"ED_CANTON_SUFRAGIO",
											"ED_SECTOR_SUFRAGIO",
											"ED_GENERO",
											"ED_ESTADO_CIVIL",
											"ED_NIVEL_FORMACION",
											"ED_INGLES",
											"FORM_NUM_COMPUS",
											"FORM_NUM_CELULARES",
											"FORM_NUM_TABLETS",
											"ED_POSEE_INTERNET",
											"ED_NUM_ESTUD_UNIV",
											"ED_NUM_ESTUD_EAC",
											"ED_NUM_ESCCOL",
											"ED_NUM_UNIVERSIDADES",
											"ED_FECHA_INGRESO",
											"ED_ESTADO");
			  $datos->campos = array("ED_SECUENCIAL",
											"ED_TIPODOCUMENTO",
											"ED_CEDULA",
											"ED_APELLIDOS",
											"ED_NOMBRES",
											"ED_FECHA_NACIMIENTO",
											"ED_CELULAR",
											"ED_CONVENCIONAL",
											"ED_CORREO",
											"ED_PAIS_NACIMIENTO",
											"ED_PROVINCIA_NACIMIENTO",
											"ED_CANTON_NACIMIENTO",
											"ED_PAIS_RESIDE",
											"ED_PROVINCIA_RESIDE",
											"ED_CANTON_RESIDE",
											"ED_PAIS_SUFRAGIO",
											"ED_PROVINCIA_SUFRAGIO",
											"ED_CANTON_SUFRAGIO",
											"ED_SECTOR_SUFRAGIO",
											"ED_GENERO",
											"ED_ESTADO_CIVIL",
											"ED_NIVEL_FORMACION",
											"ED_INGLES",
											"FORM_NUM_COMPUS",
											"FORM_NUM_CELULARES",
											"FORM_NUM_TABLETS",
											"ED_POSEE_INTERNET",
											"ED_NUM_ESTUD_UNIV",
											"ED_NUM_ESTUD_EAC",
											"ED_NUM_ESCCOL",
											"ED_NUM_UNIVERSIDADES",
											"ED_FECHA_INGRESO",
											"ED_ESTADO");
			  $datos->tabla="VW_EDUCACION";
              $datos->debug = false;
               return $this->jqtabla->finalizarTabla($this->jqtabla->getTabla($datos), $datos);
   }

}?>
