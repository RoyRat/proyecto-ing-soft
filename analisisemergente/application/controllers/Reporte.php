<?php
class Reporte extends CI_Controller{
    public function __construct() {
        parent::__construct();
		$this->load->library('PHPExcel');
        $this->load->library('EstilosExcel');
        $this->load->model('mreporte');
        $this->load->model('mvarios');
		}
    
		//Pantalla para Salud
       function salud(){
			$datos['usuario']=$this->session->userdata('US_USUARIO');
			//Para consunlta interna
			$fecha=$this->db->query("SELECT DATE_FORMAT(SYSDATE(),'%d-%m-%Y') FHASTA FROM DUAL")->row();
            $datos['SD_FECHA_INGRESOINI']=null;
            $datos['SD_FECHA_INGRESOFIN']=$fecha->FHASTA;
            //NACIMIENTO
			/*$datos['paisNacimiento']= $this->mvarios->getPaisNacimiento();
            $datos['provinciaNacimiento']= $this->mvarios->getProvinciaNacimiento();
            $datos['catonNacimiento']= $this->mvarios->getCantonNacimiento();
			//RESIDENCIA
			$datos['paisReside']= $this->mvarios->getPaisReside();
            $datos['provinciaReside']= $this->mvarios->getProvinciaReside();
            $datos['catonReside']= $this->mvarios->getCantonReside();*/
			//DATOS
			$datos['tipoSangre']= $this->mvarios->getTipoSangre();
			$datos['genero']= $this->mvarios->getGenero();
			$datos['cargoDiscapacitado']= $this->mvarios->getCargoDiscapacitado();
			$datos['discapacidad']= $this->mvarios->getDiscapacidad();
			$datos['tipoDiscapacidad']= $this->mvarios->getTipoDiscapacidad();
			$datos['enfermedades']= $this->mvarios->getEnfermedades();
			$datos['alergias']= $this->mvarios->getAlergias();
			$datos['medicacion']= $this->mvarios->getMedicacion();
			$datos['cercamsp']= $this->mvarios->getCercaMSP();
			
            $this->load->view("reporte/js/index_salud_js",$datos);
            $this->load->view("reporte/index_salud_v",$datos);
        }
		
		//Lista datos
		function getSalud(){
            echo  $this->mreporte->getSalud();
        }
		
		//Pantalla para Educación
		function educacion(){
			$datos['usuario']=$this->session->userdata('US_USUARIO');
			//Para consunlta interna
			$fecha=$this->db->query("SELECT DATE_FORMAT(SYSDATE(),'%d-%m-%Y') FHASTA FROM DUAL")->row();
            $datos['ED_FECHA_INGRESOINI']=null;
            $datos['ED_FECHA_INGRESOFIN']=$fecha->FHASTA;
			$datos['genero']= $this->mvarios->getGenero();
			$datos['estadoCivil']= $this->mvarios->getEstadoCivil();
			$datos['nivelFormacion']= $this->mvarios->getNivelFormacion();
			$datos['internet']= $this->mvarios->getInternet();
			
            $this->load->view("reporte/js/index_educacion_js",$datos);
            $this->load->view("reporte/index_educacion_v",$datos);
        }
			
		//Lista datos
		function getEducacion(){
            echo  $this->mreporte->getEducacion();
        }
		
		//Pantalla para Economía
		function economia(){
			$datos['usuario']=$this->session->userdata('US_USUARIO');
			//Para consunlta interna
			$fecha=$this->db->query("SELECT DATE_FORMAT(SYSDATE(),'%d-%m-%Y') FHASTA FROM DUAL")->row();
            $datos['EC_FECHA_INGRESOINI']=null;
            $datos['EC_FECHA_INGRESOFIN']=$fecha->FHASTA;
		$datos['genero']= $this->mvarios->getGenero();
		$datos['estadoCivil']= $this->mvarios->getEstadoCivil();
		$datos['bono']= $this->mvarios->getbono();
		$datos['labora']= $this->mvarios->getlabora();
		$datos['ingresos']= $this->mvarios->getIngresos();
		$datos['vivienda']= $this->mvarios->getVivienda();	
            $this->load->view("reporte/js/index_educacion_js",$datos);
            $this->load->view("reporte/index_educacion_v",$datos);
        }
			
		//Lista datos
		function getEconomia(){
            echo  $this->mreporte->getEconomia();
        }
		
		//Pantalla para Seguridad
		function seguridad(){
			$datos['usuario']=$this->session->userdata('US_USUARIO');
			//Para consunlta interna
			$fecha=$this->db->query("SELECT DATE_FORMAT(SYSDATE(),'%d-%m-%Y') FHASTA FROM DUAL")->row();
            $datos['SG_FECHA_INGRESOINI']=null;
            $datos['SG_FECHA_INGRESOFIN']=$fecha->FHASTA;
			$datos['genero']= $this->mvarios->getGenero();
			$datos['estadoCivil']= $this->mvarios->getEstadoCivil();
			$datos['reten']= $this->mvarios->getReten();
			$datos['alarma']= $this->mvarios->getAlarma();
			$datos['frecuenciaRobo']= $this->mvarios->getFrecuenciaRobo();
			$datos['lugarRobo']= $this->mvarios->getLugarRobo();
			$this->load->view("reporte/css/index_educacion_css", false);
            $this->load->view("reporte/js/index_educacion_js",$datos);
            $this->load->view("reporte/index_educacion_v",$datos);
        }
			
		//Lista datos
		function getSeguridad(){
            echo  $this->mreporte->getSeguridad();
        }
		
		//Pantalla para Sector
		function sector(){
			$datos['usuario']=$this->session->userdata('US_USUARIO');
			//Para consunlta interna
			$fecha=$this->db->query("SELECT DATE_FORMAT(SYSDATE(),'%d-%m-%Y') FHASTA FROM DUAL")->row();
            $datos['SC_FECHA_INGRESOINI']=null;
            $datos['SC_FECHA_INGRESOFIN']=$fecha->FHASTA;
			$datos['genero']= $this->mvarios->getGenero();
			$datos['estadoCivil']= $this->mvarios->getEstadoCivil();
			$datos['usaRedes']= $this->mvarios->getUsaRedes();
            $this->load->view("reporte/js/index_educacion_js",$datos);
            $this->load->view("reporte/index_educacion_v",$datos);
        }
			
		//Lista datos
		function getSector(){
            echo  $this->mreporte->getSector();
        }
		
//Funcion para Documentos de Recepción		
function imagenSalud(){
		
		//VARIABLES SELECCIONADAS EN CONSULTA
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
		$consul=null;
		
		//If para fechas de SD_FECHA_INGRESOINI y SD_FECHA_INGRESOFIN	
		if (!empty($SD_FECHA_INGRESOINI) and !empty($SD_FECHA_INGRESOFIN)){
		  $consul .=" AND SD_FECHA_INGRESO between 
									STR_TO_DATE('$SD_FECHA_INGRESOINI 00:00:00', '%d-%m-%Y %H:%i:%s')
										AND 
									STR_TO_DATE('$SD_FECHA_INGRESOFIN 23:59:59', '%d-%m-%Y %H:%i:%s')";              
		  }
		  
		//cmbgenero
		if($cmbgenero!='null' and !empty($cmbgenero)){
				$consul .= " AND SD_GENERO in (";
			foreach ($cmbgenero as $genero){
				$consul .= "'".pharseAmp($genero)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}
			
		//cmbtiposangre
		if($cmbtiposangre!='null' and !empty($cmbtiposangre)){
				$consul .= " AND SD_TIPO_SANGRE in (";
			foreach ($cmbtiposangre as $tiposangre){
				$consul .= "'".pharseAmp($tiposangre)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}	
		
		//cmbcargodiscapacitado
		if($cmbcargodiscapacitado!='null' and !empty($cmbcargodiscapacitado)){
				$consul .= " AND SD_CARGO_DISCAPACITADO in (";
			foreach ($cmbcargodiscapacitado as $cargodiscapacitado){
				$consul .= "'".pharseAmp($cargodiscapacitado)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}
			
		//cmbdiscapacitado
		if($cmbdiscapacitado!='null' and !empty($cmbdiscapacitado)){
				$consul .= " AND SD_POSEE_DISCPACIDAD in (";
			foreach ($cmbdiscapacitado as $discapacitado){
				$consul .= "'".pharseAmp($discapacitado)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}
			
		//cmbtipodiscapacidad
		if($cmbtipodiscapacidad!='null' and !empty($cmbtipodiscapacidad)){
				$consul .= " AND SD_TIPO_DISCAP in (";
			foreach ($cmbtipodiscapacidad as $tipodiscapacidad){
				$consul .= "'".pharseAmp($tipodiscapacidad)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}

		//cmbenfermedad
		if($cmbenfermedad!='null' and !empty($cmbenfermedad)){
				$consul .= " AND SD_POSEE_ENFERMEDAD in (";
			foreach ($cmbenfermedad as $enfermedad){
				$consul .= "'".pharseAmp($enfermedad)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}

		//cmbalergias
		if($cmbalergias!='null' and !empty($cmbalergias)){
				$consul .= " AND SD_POSEE_ALERGIA in (";
			foreach ($cmbalergias as $alergias){
				$consul .= "'".pharseAmp($alergias)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}

		//cmbmedicacion
		if($cmbmedicacion!='null' and !empty($cmbmedicacion)){
				$consul .= " AND SD_POSEE_ALERGIA in (";
			foreach ($cmbmedicacion as $medicacion){
				$consul .= "'".pharseAmp($medicacion)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}
			
		//cmbcercamsp
		if($cmbcercamsp!='null' and !empty($cmbcercamsp)){
				$consul .= " AND SD_CERCA_MSP in (";
			foreach ($cmbcercamsp as $cercamsp){
				$consul .= "'".pharseAmp($cercamsp)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}
			
		//SD_NUM_FARMACIAS
		if (!empty($SD_NUM_FARMACIAS) and ($SD_FECHA_INGRESOFIN!=0)){
		  $consul .=" AND SD_NUM_FARMACIAS=$SD_NUM_FARMACIAS";              
		  }
		  
		 //SD_NUM_HOSPITALES
		if (!empty($SD_NUM_HOSPITALES) and ($SD_NUM_HOSPITALES!=0)){
		  $consul .=" AND SD_NUM_HOSPITALES=$SD_NUM_HOSPITALES";              
		  }
		
		$SIArrayArray=array();
		$NOArrayArray=array();
		//SD_CARGO_DISCAPACITADO
		$SQLCARGODISCAPACITADO="SELECT DISTINCT (SELECT COUNT(*) FROM VW_SALUD WHERE SD_CARGO_DISCAPACITADO='SI'{$consul}) SI,
												(SELECT COUNT(*) FROM VW_SALUD WHERE SD_CARGO_DISCAPACITADO='NO'{$consul}) NO
													FROM VW_SALUD
													WHERE SD_ESTADO=0{$consul}";
		$SD_CARGO_DISCAPACITADO=$this->db->query( $SQLCARGODISCAPACITADO )->result_array();
		$SIArray=array();
		$NOarray=array();
		foreach($SD_CARGO_DISCAPACITADO as $VALOR){
					array_push($SIArray,$VALOR['SI']);
					array_push($NOarray,$VALOR['NO']);
				}
		array_push($SIArrayArray,$SIArray);
		array_push($NOArrayArray,$NOarray);
		
		//SD_CARGO_DISCAPACITADO
		$SD_POSEE_DISCPACIDAD="SELECT DISTINCT (SELECT COUNT(*) FROM VW_SALUD WHERE SD_POSEE_DISCPACIDAD='SI'{$consul}) SI,
												(SELECT COUNT(*) FROM VW_SALUD WHERE SD_POSEE_DISCPACIDAD='NO'{$consul}) NO
													FROM VW_SALUD
													WHERE SD_ESTADO=0{$consul}";
		$SD_POSEE_DISCPACIDAD=$this->db->query( $SD_POSEE_DISCPACIDAD )->result_array();
		$SIArray=array();
		$NOarray=array();
		foreach($SD_POSEE_DISCPACIDAD as $VALOR){
					array_push($SIArray,$VALOR['SI']);
					array_push($NOarray,$VALOR['NO']);
				}		
				
		array_push($SIArrayArray,$SIArray);
		array_push($NOArrayArray,$NOarray);
		
		//SD_POSEE_ENFERMEDAD
		$SD_POSEE_ENFERMEDAD="SELECT DISTINCT (SELECT COUNT(*) FROM VW_SALUD WHERE SD_POSEE_ENFERMEDAD='SI'{$consul}) SI,
												(SELECT COUNT(*) FROM VW_SALUD WHERE SD_POSEE_ENFERMEDAD='NO'{$consul}) NO
													FROM VW_SALUD
													WHERE SD_ESTADO=0{$consul}";
		$SD_POSEE_ENFERMEDAD=$this->db->query( $SD_POSEE_ENFERMEDAD )->result_array();
		$SIArray=array();
		$NOarray=array();
		foreach($SD_POSEE_ENFERMEDAD as $VALOR){
					array_push($SIArray,$VALOR['SI']);
					array_push($NOarray,$VALOR['NO']);
				}
		array_push($SIArrayArray,$SIArray);
		array_push($NOArrayArray,$NOarray);
		
		//SD_POSEE_ALERGIA
		$SD_POSEE_ALERGIA="SELECT DISTINCT (SELECT COUNT(*) FROM VW_SALUD WHERE SD_POSEE_ALERGIA='SI'{$consul}) SI,
											(SELECT COUNT(*) FROM VW_SALUD WHERE SD_POSEE_ALERGIA='NO'{$consul}) NO
													FROM VW_SALUD
													WHERE SD_ESTADO=0{$consul}";
		$SD_POSEE_ALERGIA=$this->db->query( $SD_POSEE_ALERGIA )->result_array();
		$SIArray=array();
		$NOarray=array();
		foreach($SD_POSEE_ALERGIA as $VALOR){
					array_push($SIArray,$VALOR['SI']);
					array_push($NOarray,$VALOR['NO']);
				}
		array_push($SIArrayArray,$SIArray);
		array_push($NOArrayArray,$NOarray);
		
		//SD_POSEE_MEDICACION
		$SD_POSEE_MEDICACION="SELECT DISTINCT (SELECT COUNT(*) FROM VW_SALUD WHERE SD_POSEE_MEDICACION='SI'{$consul}) SI,
											(SELECT COUNT(*) FROM VW_SALUD WHERE SD_POSEE_MEDICACION='NO'{$consul}) NO
												FROM VW_SALUD
												WHERE SD_ESTADO=0{$consul}";
		$SD_POSEE_MEDICACION=$this->db->query( $SD_POSEE_MEDICACION )->result_array();
		$SIArray=array();
		$NOarray=array();
		foreach($SD_POSEE_MEDICACION as $VALOR){
					array_push($SIArray,$VALOR['SI']);
					array_push($NOarray,$VALOR['NO']);
				}
		array_push($SIArrayArray,$SIArray);
		array_push($NOArrayArray,$NOarray);
		
		//SD_CERCA_MSP
		$SD_CERCA_MSP="SELECT DISTINCT (SELECT COUNT(*) FROM VW_SALUD WHERE SD_CERCA_MSP='SI'{$consul}) SI,
										(SELECT COUNT(*) FROM VW_SALUD WHERE SD_CERCA_MSP='NO'{$consul}) NO
													FROM VW_SALUD
													WHERE SD_ESTADO=0{$consul}";
		$SD_CERCA_MSP=$this->db->query( $SD_CERCA_MSP )->result_array();
		$SIArray=array();
		$NOarray=array();
		foreach($SD_CERCA_MSP as $VALOR){
					array_push($SIArray,$VALOR['SI']);
					array_push($NOarray,$VALOR['NO']);
				}
		array_push($SIArrayArray,$SIArray);
		array_push($NOArrayArray,$NOarray);		
		//VARIABLES DE ENVIO DE DATOS
		$datos['SI']=json_encode($SIArrayArray, JSON_NUMERIC_CHECK);
		$datos['NO']=json_encode($NOArrayArray, JSON_NUMERIC_CHECK);
		
		//SD_NUM_FARMACIAS
		$SD_NUM_FARMACIAS="SELECT SD_NUM_FARMACIAS,
									COUNT(SD_NUM_FARMACIAS) SD_CONT_FARMACIAS
												FROM VW_SALUD
												WHERE SD_ESTADO=0{$consul}
							GROUP BY SD_NUM_FARMACIAS";
		$SD_NUM_FARMACIAS=$this->db->query( $SD_NUM_FARMACIAS )->result_array();
		$CATEGORIAFarray=array();
		$CATVALFarray=array();
		foreach($SD_NUM_FARMACIAS as $VALOR){
					array_push($CATEGORIAFarray,$VALOR['SD_NUM_FARMACIAS']);
					array_push($CATVALFarray,$VALOR['SD_CONT_FARMACIAS']);
				}
		$datos['CATEGORIAFNUM']=json_encode($CATEGORIAFarray, JSON_NUMERIC_CHECK);
		$datos['CATEGORIAFVAL']=json_encode($CATVALFarray, JSON_NUMERIC_CHECK);
		
		//SD_NUM_HOSPITALES
		$SD_NUM_HOSPITALES="SELECT SD_NUM_HOSPITALES,COUNT(SD_NUM_HOSPITALES) SD_CONT_HOSPITALES
													FROM VW_SALUD
													WHERE SD_ESTADO=0{$consul}
								GROUP BY SD_NUM_HOSPITALES";
		$SD_NUM_HOSPITALES=$this->db->query( $SD_NUM_HOSPITALES )->result_array();
		$CATEGORIHArray=array();
		$CATVALHarray=array();
		foreach($SD_NUM_HOSPITALES as $VALOR){
					array_push($CATEGORIHArray,$VALOR['SD_NUM_HOSPITALES']);
					array_push($CATVALHarray,$VALOR['SD_CONT_HOSPITALES']);
				}
		$datos['CATEGORIAHNUM']=json_encode($CATEGORIHArray, JSON_NUMERIC_CHECK);
		$datos['CATEGORIAHVAL']=json_encode($CATVALHarray, JSON_NUMERIC_CHECK);
				
		$categoriasArray=array('CARGO DISCAPACITADO',
								'POSEE DISCAPACIDAD',
								'POSEE ENFERMEDAD',
								'POSEE ALERGIAS',
								'USA MEDICAMENTOS',								
								'MSP',
								'# FARMACIAS',
								'# HOSPITALES/CLINICAS');
		$datos['container']=json_encode($categoriasArray, JSON_NUMERIC_CHECK);
		$datos['categorias']=json_encode($categoriasArray, JSON_NUMERIC_CHECK);
		$datos['containerArray']=$categoriasArray;
		$TITULODESCARGAArray=array('SALUD-CARGODISCAPACITADO',
									'SALUD-POSEEDISCAPACIDAD',
									'SALUD-POSEEENFERMEDAD',
									'SALUD-POSEEALERGIAS',
									'SALUD-USAMEDICAMENTOS',									
									'SALUD-MSP',
									'SALUD-FARMACIAS',
									'SALUD-HOSPITALESCLINICAS');
		$datos['TITULODESCARGA']=json_encode($TITULODESCARGAArray, JSON_NUMERIC_CHECK);
		$datos['nombrearchivo']=json_encode($TITULODESCARGAArray, JSON_NUMERIC_CHECK);
		
		//CARGA DE VISTA
        $this->load->view("reporte/imagensalud_v", $datos,false);
}

//Funcion para generar PDF de documentos recepción
function fmtSaludPdf(){
	ini_set("memory_limit", "-1");
	set_time_limit(0);

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

	$this->load->library('pdf');
	$this->pdf->SetSubject('Indicador SALUD');
	$this->pdf->setPageOrientation('L','A4');
	$this->pdf->AddPage();
	$consul=null;
			
					
		//If para fechas de SD_FECHA_INGRESOINI y SD_FECHA_INGRESOFIN	
		if (!empty($SD_FECHA_INGRESOINI) and !empty($SD_FECHA_INGRESOFIN)){
		  $consul .=" AND SD_FECHA_INGRESO between 
									STR_TO_DATE('$SD_FECHA_INGRESOINI 00:00:00', '%d-%m-%Y %H:%i:%s')
										AND 
									STR_TO_DATE('$SD_FECHA_INGRESOFIN 23:59:59', '%d-%m-%Y %H:%i:%s')";              
		  }
		  
		//cmbgenero
		if($cmbgenero!='null' and !empty($cmbgenero)){
				$consul .= " AND SD_GENERO in (";
			foreach ($cmbgenero as $genero){
				$consul .= "'".pharseAmp($genero)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}
			
		//cmbtiposangre
		if($cmbtiposangre!='null' and !empty($cmbtiposangre)){
				$consul .= " AND SD_TIPO_SANGRE in (";
			foreach ($cmbtiposangre as $tiposangre){
				$consul .= "'".pharseAmp($tiposangre)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}	
		
		//cmbcargodiscapacitado
		if($cmbcargodiscapacitado!='null' and !empty($cmbcargodiscapacitado)){
				$consul .= " AND SD_CARGO_DISCAPACITADO in (";
			foreach ($cmbcargodiscapacitado as $cargodiscapacitado){
				$consul .= "'".pharseAmp($cargodiscapacitado)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}
			
		//cmbdiscapacitado
		if($cmbdiscapacitado!='null' and !empty($cmbdiscapacitado)){
				$consul .= " AND SD_POSEE_DISCPACIDAD in (";
			foreach ($cmbdiscapacitado as $discapacitado){
				$consul .= "'".pharseAmp($discapacitado)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}
			
		//cmbtipodiscapacidad
		if($cmbtipodiscapacidad!='null' and !empty($cmbtipodiscapacidad)){
				$consul .= " AND SD_TIPO_DISCAP in (";
			foreach ($cmbtipodiscapacidad as $tipodiscapacidad){
				$consul .= "'".pharseAmp($tipodiscapacidad)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}

		//cmbenfermedad
		if($cmbenfermedad!='null' and !empty($cmbenfermedad)){
				$consul .= " AND SD_POSEE_ENFERMEDAD in (";
			foreach ($cmbenfermedad as $enfermedad){
				$consul .= "'".pharseAmp($enfermedad)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}

		//cmbalergias
		if($cmbalergias!='null' and !empty($cmbalergias)){
				$consul .= " AND SD_POSEE_ALERGIA in (";
			foreach ($cmbalergias as $alergias){
				$consul .= "'".pharseAmp($alergias)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}

		//cmbmedicacion
		if($cmbmedicacion!='null' and !empty($cmbmedicacion)){
				$consul .= " AND SD_POSEE_ALERGIA in (";
			foreach ($cmbmedicacion as $medicacion){
				$consul .= "'".pharseAmp($medicacion)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}
			
		//cmbcercamsp
		if($cmbcercamsp!='null' and !empty($cmbcercamsp)){
				$consul .= " AND SD_CERCA_MSP in (";
			foreach ($cmbcercamsp as $cercamsp){
				$consul .= "'".pharseAmp($cercamsp)."',";
			}
				$consul = substr($consul,0,-1);
				$consul .=")";
			}
			
		//SD_NUM_FARMACIAS
		if (!empty($SD_NUM_FARMACIAS) and ($SD_FECHA_INGRESOFIN!=0)){
		  $consul .=" AND SD_NUM_FARMACIAS=$SD_NUM_FARMACIAS";              
		  }
		  
		 //SD_NUM_HOSPITALES
		if (!empty($SD_NUM_HOSPITALES) and ($SD_NUM_HOSPITALES!=0)){
		  $consul .=" AND SD_NUM_HOSPITALES=$SD_NUM_HOSPITALES";              
		  }
				
		$imagenArray=array('SALUD-CARGODISCAPACITADO',
									'SALUD-POSEEDISCAPACIDAD',
									'SALUD-POSEEENFERMEDAD',
									'SALUD-POSEEALERGIAS',
									'SALUD-USAMEDICAMENTOS',									
									'SALUD-MSP',
									'SALUD-FARMACIAS',
									'SALUD-HOSPITALESCLINICAS');
		$datos['imagenes']=$imagenArray;
		
		$tituloArray=array('CARGO DISCAPACITADO',
								'POSEE DISCAPACIDAD',
								'POSEE ENFERMEDAD',
								'POSEE ALERGIAS',
								'USA MEDICAMENTOS',								
								'MSP',
								'# FARMACIAS',
								'# HOSPITALES/CLINICAS');
		$datos['tituloGrafica']=$tituloArray;

		$SQLCONPDF="SELECT SD_SECUENCIAL,
					SD_TIPODOCUMENTO,
					SD_CEDULA,
					SD_APELLIDOS,
					SD_NOMBRES,
					SD_FECHA_NACIMIENTO,
					SD_CELULAR,
					SD_CONVENCIONAL,
					SD_CORREO,
					SD_PAIS_NACIMIENTO,
					SD_PROVINCIA_NACIMIENTO,
					SD_CANTON_NACIMIENTO,
					SD_PAIS_RESIDE,
					SD_PROVINCIA_RESIDE,
					SD_CANTON_RESIDE,
					SD_PAIS_SUFRAGIO,
					SD_PROVINCIA_SUFRAGIO,
					SD_CANTON_SUFRAGIO,
					SD_SECTOR_SUFRAGIO,
					SD_GENERO,
					SD_ESTADO_CIVIL,
					SD_TIPO_SANGRE,
					SD_CARGO_DISCAPACITADO,
					SD_POSEE_DISCPACIDAD,
					SD_PORCENTAJE_DISCAP,
					SD_CARNE_CONADIS,
					SD_TIPO_DISCAP,
					SD_POSEE_ENFERMEDAD,
					SD_ENFERMEDADDES,
					SD_POSEE_ALERGIA,
					SD_ALERGIADES,
					SD_POSEE_MEDICACION,
					SD_MEDICACIONDES,
					SD_NUM_FARMACIAS,
					SD_NUM_HOSPITALES,
					SD_CERCA_MSP,
					SD_FECHA_INGRESO,
					SD_ESTADO
					FROM VW_SALUD
					WHERE SD_ESTADO=0{$consul}
					";
					/*GROUP BY SD_CARGO_DISCAPACITADO,SD_POSEE_DISCPACIDAD,SD_POSEE_ENFERMEDAD,
							SD_POSEE_ALERGIA,SD_POSEE_MEDICACION,SD_NUM_FARMACIAS,SD_NUM_HOSPITALES,SD_CERCA_MSP
					ORDER BY SD_FECHA_INGRESO,SD_APELLIDOS,SD_GENERO,SD_CARGO_DISCAPACITADO,SD_POSEE_DISCPACIDAD,
							SD_POSEE_ENFERMEDAD,SD_POSEE_ALERGIA,SD_POSEE_MEDICACION,SD_NUM_FARMACIAS,SD_NUM_HOSPITALES,SD_CERCA_MSP ASC*/
		//print_r($SQLCONPDF);
	$datos['consultas']=$this->db->query( $SQLCONPDF )->result_array();
	if(empty($datos['consultas'])){
		$mensaje = alerta("No se Encontrarón Resultados");
	}else{
		$this->pdf->SetFont('times', '', 8);
		$datos['titulo']='Indicador por Salud';
		$datos['subtitulo']="ANÁLISIS EMERGENTES";
		$datos['subtitulo2']='';
		$datos['subtitulo3']='';
		$this->pdf->writeHTML($this->load->view("reporte/reportes/fmt_salud",$datos,true), true, false, true, false, '');
		$fecha = @date("d-m-Y");
		$hora = @date("H-i");
		$archivo="tmp/ReportePDF_SALUD_".$fecha."_".$hora.".pdf";
		$this->pdf->Output($archivo, 'F');
	$mensaje = "<iframe src='{$archivo}' width='1020' height='700'></iframe>";
	}
	echo json_encode(array("mensaje" => $mensaje));
}

}?>
