<?php
class Hoja extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('mhoja');
        $this->load->model('mvarios');
    }
    
       function index(){
			$datos=$this->datos(null,'n');
            $datos['accion'] = 'n';			
            $this->load->view("hoja/hoja_v",$datos);
            $this->load->view("hoja/js/hoja_js",$datos);
        }
        
               	
	//funcion para cear una nuevo registro
	public function nuevaHoja(){
            $datos=$this->datos(null,'n');
            $datos['accion'] = 'n';
            $this->load->view("hoja/hoja_v",$datos);
            $this->load->view("hoja/js/hoja_js",$datos);
        }
        
                     
	//funcion para dar los valores a la cabecera tanto en nuevo, como al momento de editar
	function datos($sol,$accion){
        // Christian Carrera actualizacion de obtencion de datos del formulario web
        if ($accion=='n') {
			$datos['combo_documento']=$this->cmb_documento(null,"  class='custom-select' id='FORM_TIPODOCUMENTO'");
			
			$datos['combo_paisnacionalidad']= $this->mvarios->cmb_paisnacionalidad(null," class='custom-select' id='LOC_PAISNAC'");
			$datos['combo_provincianacionalidad']=$this->mvarios->cmb_provincianacionalidad(null,null,"  class='custom-select' id='LOC_PROVINCIANAC'");
			$datos['combo_ciudadnacionalidad']=$this->mvarios->cmb_ciudadnacionalidad(null,null,"  class='custom-select' id='LOC_CIUDADNAC'");			
			
			$datos['combo_paisreside']= $this->mvarios->cmb_paisreside(null," class='custom-select' id='LOC_PAISRESIDE'");
			$datos['combo_provinciareside']=$this->mvarios->cmb_provinciareside(null,null,"  class='custom-select' id='LOC_PROVINCIARESIDE'");
			$datos['combo_ciudadreside']=$this->mvarios->cmb_ciudadreside(null,null,"  class='custom-select' id='LOC_CIUDADRESIDE'");
			
			$datos['combo_paissufragio']= $this->mvarios->cmb_paissufragio(null," class='custom-select' id='LOC_PAISSUFRAG'");
			$datos['combo_provinciasufragio']=$this->mvarios->cmb_provinciasufragio(null,null,"  class='custom-select' id='LOC_PROVINCIASUFRAG'");
			$datos['combo_ciudadsufragio']=$this->mvarios->cmb_ciudadsufragio(null,null,"  class='custom-select' id='LOC_CIUDADSUFRAG'");
			$datos['combo_sectorsufragio']=$this->mvarios->cmb_sectorsufragio(null,null,"  class='custom-select' id='LOC_SECTORSUFRAG'");
			
			$datos['combo_genero']=$this->cmb_genero(null,"class='custom-select' id='FORM_GENERO'");
            $datos['combo_civil']=$this->cmb_civil(null,"  class='custom-select' id='FORM_ESTADO_CIVIL'");
            $datos['combo_tipoSangre']=$this->cmb_tipoSangre(null," class='custom-select' id='FORM_TIPO_SANGRE'");
            $datos['combo_etnia']=$this->cmb_etnia(null," class='custom-select' id='FORM_ETNIA'");
			$datos['combo_pueblos']=$this->cmb_pueblos(null,"class='custom-select' id='FORM_PUEBLOS'");			
			$datos['combo_formacion']=$this->cmb_formacion(null,"class='custom-select' id='FORM_NIVEL_FORMACION'");
			$datos['combo_idioma']=$this->cmb_idioma(null,"  class='custom-select' id='FORM_INGLES'");		
			$datos['combo_internet']=$this->cmb_internet(null,"class='custom-select' id='FORM_POSEE_INTERNET'");
			
			$datos['combo_relacioncontacto']=$this->cmb_relacioncontacto(null,"  class='custom-select' id='FORM_RELACION_CONTACTO'");
			
            $datos['combo_cargodiscapacidad']=$this->cmb_cargodiscapacidad(null,"  class='custom-select' id='FORM_CARGO_DISCAPACITADO'");
            $datos['combo_discapacidad']=$this->cmb_discapacidad(null,"  class='custom-select' id='FORM_POSEE_DISCAPACIDAD'");
            $datos['combo_tipoDiscapacidad']=$this->cmb_tipoDiscapacidad(null,"  class='custom-select' id='FORM_TIPO_DISCAP'");
			$datos['combo_enfermedad']=$this->cmb_enfermedad(null," class='custom-select' id='FORM_POSEE_ENFERMEDAD'");
            $datos['combo_alergia']=$this->cmb_alergia(null,"  class='custom-select' id='FORM_POSEE_ALERGIA'");
            $datos['combo_medicacion']=$this->cmb_medicacion(null,"  class='custom-select' id='FORM_POSEE_MEDICACION'");            
            $datos['combo_cercamsp']=$this->cmb_cercamsp(null,"class='custom-select' id='FORM_CERCA_MSP'");
			
			$datos['combo_bono']=$this->cmb_bono(null,"  class='custom-select' id='FORM_RECIBE_BONO'");
            $datos['combo_trabajo']=$this->cmb_trabajo(null,"  class='custom-select' id='FORM_LABORA'");            
            $datos['combo_usoIngresos']=$this->cmb_usoIngresos(null,"class='custom-select' id='FORM_USA_INGRESOS'");            
            $datos['combo_vivienda']=$this->cmb_vivienda(null,"class='custom-select' id='FORM_VIVIENDA'");
            
			$datos['combo_cercareten']=$this->cmb_cercareten(null,"class='custom-select' id='FORM_CERCA_RETEN'");
            $datos['combo_alarma']=$this->cmb_alarma(null,"class='custom-select' id='FORM_ALARMA_COMUNITARIA'");
            $datos['combo_frecuencia']=$this->cmb_frecuencia(null,"class='custom-select' id='FORM_FRECUENCIA_ROBOS'");
            $datos['combo_lugarrobos']=$this->cmb_lugarrobos(null,"class='custom-select' id='FORM_LUGAR_ROBOS'");           
            			
			$datos['combo_usaredes']=$this->cmb_usaredes(null,"  class='custom-select' id='FORM_REDSOCIAL'");
			$datos['combo_tiporedes']=$this->cmb_tiporedes(null,"  class='custom-select' id='FORM_TIPOREDSOCIAL'");
       } else {
			//Caso para la edición de un registro
			$datos=null;
        }
        return($datos);
     }
	
	//Combo para generos
    function  cmb_documento($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TIPO DOCUMENTO";
        $output[1] = "Cédula de Identidad";
        $output[2] = "Pasaporte/RUC/Otra Identificación";
        return form_dropdown('documento', $output, $tipo, $attr);
    }
		
	
	//Combo para generos
    function  cmb_genero($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "GÉNERO";
        $output['M'] = "Masculino";
        $output['F'] = "Femenino";
        return form_dropdown('genero', $output, $tipo, $attr);
    }
	
	//Combo para estado civil
    function  cmb_civil($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "ESTADO CIVIL";
        $output['S'] = "Soltero/a";
        $output['C'] = "Casado/a";
		$output['D'] = "Divorciado/a";
		$output['U'] = "Unión Libre";        
        $output['V'] = "Viudo/a";
        return form_dropdown('civil', $output, $tipo, $attr);
    }
	
	//Combo para tipo de sangre
    function  cmb_tipoSangre($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TIPO DE SANGRE";
        $output['AP'] = "A+";
        $output['AN'] = "A-";
        $output['BP'] = "B+";
        $output['BN'] = "B-";
        $output['OP'] = "O+";
        $output['ON'] = "O-";
        $output['ABP'] = "AB+";
        $output['ABN'] = "AB-";
        return form_dropdown('tipoSangre', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_etnia($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "ETNIA";
        $output['IN'] = "Indígena";
        $output['AE'] = "Afroecuatoriano";
        $output['NE'] = "Negro";
        $output['MU'] = "Mulato";
        $output['MO'] = "Montuvio";
        $output['ME'] = "Mestizo";
        $output['BL'] = "Blanco";
        $output['OT'] = "Otro";
        $output['NA'] = "No Aplica";
        return form_dropdown('etnia', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_pueblos($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TIPO DE PUEBLOS";
        $output[1] = "Kichwa";
		$output[2] = "Awá";
		$output[3] = "Chachi";
		$output[4] = "Épera";
		$output[5] = "Tsáchila";
		$output[6] = "Achuar";
		$output[7] = "Cofán";
		$output[8] = "Secoya";
		$output[9] = "Shiwiar";
		$output[10] = "Shuar";
		$output[11] = "Waorani";
		$output[12] = "Sápara";
		$output[13] = "Andoa";
		$output[14] = "Siona";
		$output[15] = "Huancavilca";
		$output[16] = "Manta";
		$output[17] = "Palta";
		$output[18] = "Chibuleo";
		$output[19] = "Kañari";
		$output[20] = "Karanki";
		$output[21] = "Kayampi";
		$output[22] = "Kisapincha";
		$output[23] = "Kitu-Kara";
		$output[24] = "Natabuela";
		$output[25] = "Otavalo";
		$output[26] = "Panzaleo";
		$output[27] = "Puruhá";
		$output[28] = "Salasaca";
		$output[29] = "Saraguro";
		$output[30] = "Tomabela";
		$output[31] = "Waranka";
		$output[32] = "Quijos";
		$output[33] = "Pasto";
		$output[34] = "Otro";
		$output[35] = "No aplica";
        return form_dropdown('pueblos', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_relacioncontacto($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "RELACIÓN";
        $output[1] = "Madre";
        $output[2] = "Padre";
        $output[3] = "Hermano/a";
        $output[4] = "Esposo/a";
        $output[5] = "Cónyuge";
        $output[6] = "Amigo/a";
        $output[7] = "Otros";
        $output[8] = "No aplica";
        return form_dropdown('relcontacto', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_formacion($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "FORMACIÓN";
        $output[1] = "Centro alfabetización";
        $output[2] = "Jardín de infantes";
        $output[3] = "Primaria";
        $output[4] = "Educación básica";
        $output[5] = "Secundaria";
        $output[6] = "Bachillerato";
        $output[7] = "Educación media";
        $output[8] = "Estudiante Pregrado";
        $output[9] = "Estudiante Postgrado";
        $output[10] = "Superior universitaria";
		$output[11] = "Superior no universitaria";        
        $output[12] = "Posgrado";
        $output[13] = "PHD";
        $output[14] = "No aplica";
        return form_dropdown('formacion', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_idioma($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "CERTIFICACIÓN";
        $output[1] = "A1";
        $output[2] = "A2";
        $output[3] = "B1";
        $output[4] = "B2";
        $output[5] = "TOFEL";
        $output[6] = "Ninguna";
        return form_dropdown('idioma', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_internet($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "POSEE INTERNET";
        $output[1] = "SI";
		$output[0] = "NO";        
        return form_dropdown('internet', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_cargodiscapacidad($tipo = null, $attr = null){
        $output = array();
        $output[null] = "TIENE A CARGO UN DISCAPACITADO";
        $output[1] = "SI";
		$output[0] = "NO";        
        return form_dropdown('cargodiscapacidad', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_discapacidad($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TIENE DISCAPACIDAD";
        $output[1] = "SI";
		$output[0] = "NO";        
        return form_dropdown('discapacidad', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_tipoDiscapacidad($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "DISCAPACIDAD";
        $output[1] = "Intelectual";
        $output[2] = "Física";
        $output[3] = "Visual";
        $output[4] = "Auditiva";
        $output[5] = "Mental";
        $output[6] = "Otro";
        return form_dropdown('tipoDiscapacidad', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_enfermedad($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TIENE ALGUNA ENFERMEDAD";
        $output[1] = "SI";
		$output[0] = "NO";        
        return form_dropdown('enfermedad', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_alergia($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TIENE ALERGIAS";
        $output[1] = "SI";
		$output[0] = "NO";        
        return form_dropdown('alergia', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_medicacion($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TOMA MEDICACIÓN";
        $output[1] = "SI";
		$output[0] = "NO";        
        return form_dropdown('medicacion', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_cercamsp($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TIENE CERCA MINISTERIO DE SALUD PÚBLICA";
        $output[1] = "SI";
		$output[0] = "NO";        
        return form_dropdown('cercamsp', $output, $tipo, $attr);
    }
	
	
	//Combo para generos
    function  cmb_bono($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "RECIBE BONO";
        $output[1] = "SI";
		$output[0] = "NO";        
        return form_dropdown('bono', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_trabajo($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TRABAJO";
        $output[1] = "SI";
        $output[0] = "NO";
        return form_dropdown('trabajo', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_usoIngresos($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "USO DE INGRESOS";
        $output[1] = "Financiar sus estudios";
        $output[2] = "Mantener su hogar";
        $output[3] = "Gastos personales no esenciales";
        $output[4] = "Financiar sus estudios y mantener su hogar";
        $output[5] = "Otros";
        $output[6] = "No aplica";
        return form_dropdown('usoIngresos', $output, $tipo, $attr);
    }
		
	//Combo para generos
    function  cmb_vivienda($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TIPO DE VIVIENDA";
        $output[1] = "Propia";
        $output[2] = "Arrienda";
        $output[3] = "Antecresis";
        $output[4] = "De Familiares";
        $output[5] = "Cuida";
        $output[6] = "Compratida";
        $output[7] = "Otro";
        return form_dropdown('vivienda', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_cercareten($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TIENE CERCA RETÉN POLICIAL";
        $output[1] = "SI";
		$output[0] = "NO";        
        return form_dropdown('cercareten', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_alarma($tipo = null, $attr = null){
        $output = array();
        $output[null] = "TIENE ALARMA COMUNITARIA";
        $output[1] = "SI";
		$output[0] = "NO";
        return form_dropdown('alarma', $output, $tipo, $attr);
    }
		
	//Combo para generos
    function  cmb_frecuencia($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "FRECUENCIA DE ROBOS";
        $output[1] = "06:00 A 09:00";
        $output[2] = "12:00 A 14:00";
        $output[3] = "17:00 A 21:00";
        $output[4] = "MADRUGADA";
        $output[5] = "HORARIOS NO LABORALES";
        $output[6] = "N/A";
        return form_dropdown('frecuencia', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_lugarrobos($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "LUGAR DE ROBOS";
        $output[1] = "PARADAS DE BUSES";
        $output[2] = "BUSES";
        $output[3] = "CALLEJONES";
        $output[4] = "CASAS";
        $output[5] = "CALLES PRINCIPALES";
        $output[6] = "CALLES TRANSVERSALES";
        $output[7] = "OTROS";
        $output[8] = "N/A";
        return form_dropdown('lugarrobos', $output, $tipo, $attr);
    }
	
	
	//Combo para generos
    function  cmb_usaredes($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "USA REDES SOCIALES";
        $output[1] = "SI";
        $output[0] = "NO";
        return form_dropdown('redsocial', $output, $tipo, $attr);
    }
	
	//Combo para generos
    function  cmb_tiporedes($tipo = null, $attr = null) {
        $output = array();
        $output[null] = "TIPO DE REDES SOCIALES";
        $output[1] = "Facebook";
        $output[2] = "Skype";
        $output[3] = "LinkID";
        $output[4] = "Twitter";
        $output[5] = "Instagram";
        return form_dropdown('tiporedes', $output, $tipo, $attr);
    }
	
			
	//Administra las foncuiones de nuevo y editar en un registro
    function admHoja($accion){
        switch($accion){
            case 'n':
                echo $this->mhoja->addHoja();
                break;
            case 'e':
                echo $this->mhoja->editHoja();
                break;
        }        
    }
	
	function nuevoForm(){
            echo  $this->mhoja->addHoja();
        }

		
}
?>