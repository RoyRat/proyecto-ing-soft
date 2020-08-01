<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	
	function prepararNombreArchivo($str = null){
        return is_string($str)?utf8_encode(regCaracteresEspecialers(trim(fullUpper($str)))):$str;
	}
	
    function prepCampoMostrar($str){
        return is_string($str)?utf8_encode(trim($str)):trim(utf8_encode($str));
	}
	
    function remplazar_puntosXcomas($str){
        return utf8_decode(str_replace(",",".",$str));
	}
    
    function eliminarElementosArray($arreglo = null, $elementos = null){
        foreach ($elementos as $indice){
            unset($arreglo[$indice]);
		}
        return $arreglo;
	} 
    
    function prepCampoAlmacenar($string){
    	return trim(utf8_decode(str_compat($string)));
	}
	
	function str_compat($str = null){
		return strtr($str, array(
		"'"=>"''"
    	));
	}
    
    function regCaracteresEspecialers($str = null){
        return strtr($str, array(
		"À"=>"A","È"=>"E","Ì"=>"I","Ò"=>"O","Ù"=>"U","Ñ"=>"N",
		"Á"=>"A","É"=>"E","Í"=>"I","Ó"=>"O","Ú"=>"U","Â"=>"A",
		"Ê"=>"E","Î"=>"I","Ô"=>"O","Û"=>"U","Ç"=>"C",
		"à"=>"a","è"=>"e","ì"=>"i","ò"=>"o","ù"=>"u","ñ"=>"n",
		"á"=>"a","é"=>"e","í"=>"i","ó"=>"o","ú"=>"u","â"=>"a",
		"ê"=>"e","î"=>"i","ô"=>"o","û"=>"u","ç"=>"c",
		" "=>"_",
		"."=>""
    	));
	}
    
	//Funcion para ayuda de caracteres especiales
	function regCaracteresEspecialers2($str = null){
        return strtr($str, array(
		"À"=>"A","È"=>"E","Ì"=>"I","Ò"=>"O","Ù"=>"U","Ñ"=>"N",
		"Á"=>"A","É"=>"E","Í"=>"I","Ó"=>"O","Ú"=>"U","Â"=>"A",
		"Ê"=>"E","Î"=>"I","Ô"=>"O","Û"=>"U","Ç"=>"C",
		"à"=>"a","è"=>"e","ì"=>"i","ò"=>"o","ù"=>"u","ñ"=>"n",
		"á"=>"a","é"=>"e","í"=>"i","ó"=>"o","ú"=>"u","â"=>"a",
		"ê"=>"e","î"=>"i","ô"=>"o","û"=>"u","ç"=>"c",
		" "=>"",
		"."=>""
    	));
	}
    
    function fullUpper($string){
    	return strtr(strtoupper($string), array(
		"á"=>"Á", 
		"é"=>"É",
		"í"=>"Í",
		"ó"=>"Ó",
		"ú"=>"Ú",
		"ñ"=>"Ñ",
		"Á"=>"Á", 
		"É"=>"É",
		"Í"=>"Í",
		"Ó"=>"Ó",
		"Ú"=>"Ú",
		"Ñ"=>"Ñ"
    	));
	}
	
	function highlight($str){
		$str = '<div class="ui-widget">
		<div class="ui-state-highlight ui-corner-all"style="margin: 10px 3px !important; padding: 0 .4em !important;">
		<p style=" margin: 3px !important;">
		
		<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
		<strong>Aviso:</strong>
		'.$str.'
		</p>
		</div>
		</div>';
		return $str;
	}
	
	function alerta($str){
		$str = '<div class="ui-widget">
		<div class="ui-state-error ui-corner-all" style="margin: 10px 3px !important; padding: 0 .4em;">
		<p>
		<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
		<strong>Alerta:</strong>
		'.$str.'
		</p>
		</div>
		</div>';    
		return $str;
	}
	
	function success($str){
		$str = '<div class="ui-widget">
		<div class="ui-state-success ui-corner-all" style="margin: 10px 3px !important; padding: 0 .4em;">
		<p>
		<span class="ui-icon ui-icon-circle-check" style="float: left; margin-right: .3em;"></span>
		<strong>Aviso:</strong>
		'.$str.'
		</p>
		</div>
		</div>';
		return $str;
	}
	
	function countchar ($string) {
		$result = strlen ($string)  - substr_count($string, ' ');
		return $result; 
	} 
	
	function unirArreglo($datos, $pega = ', '){
		$CI =& get_instance();
		$ac = array();
        foreach($datos as $ix => $e){
            $ac[] = "$ix=".$CI->db->escape($e);
		}
		return join($pega, $ac);
	}
	
	function jsOpcionTabla($datos){
		$ajs = array();
        foreach($datos as $f){
        	$attr = get_object_vars($f);
        	$a = array();
        	foreach($attr as $c){
				$a[] = $c;
			}        	
        	$ajs[] = join(':', $a);
		}
        $cjs = '{value:"' . join(';', $ajs) . '"}';
        return $cjs;
	}
	
	function opcionesSelect($datos, $ponerTodos = 0,$vacio = null){
		$ao = array();
		if(is_array($ponerTodos)){
			$claves = array_keys($ponerTodos);
			$valores = array_values($ponerTodos);
			$ao[$claves[0]] = $valores[0];
		}
		foreach($datos as $f){
			$attr = get_object_vars($f);
			$ac = array();
			foreach($attr as $c){
				$ac[]  = getUTF8(trim($c));
			}
			$ao[$ac[0]] = $ac[1];
		}
		
		return $ao;
	}
	
	function opcionesChainedSelect($datos, $ponerTodos = 0){
		$respuesta = array();
		foreach(opcionesSelect($datos, $ponerTodos) as $ix => $el){
			array_push($respuesta, array($ix => $el));
		}
		return json_encode($respuesta);
	}
	
	function getUTF8($str){
		$esUTF8 = mb_detect_encoding($str, 'UTF-8', true);
		if(!$esUTF8){
			return utf8_encode($str);
		}
		return $str;
	}
	
	function selectHTML($datos){
		$ad = opcionesSelect($datos);
		$c = '<select>';
		foreach($ad as $ix => $v)
		{
			$c .= '<option value="'.$ix.'">'.$v.'</option>';
		}
		return $c.'</select>';
	}
	
	function minus2mayus($str)
	{
		$str = strtoupper($str);
		return str_replace($minus, $mayus, $str);
	}
	
	function obtenerFechaEspanol($fecha){
		$fecha = strtoupper($fecha);
		$origen =  array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 
		'SEP', 'OCT', 'NOV', 'DEC' );
		$destino = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 
		'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		
		return str_replace($origen, $destino, $fecha);
	}
	
	function mes($fecha){
		$mes =  substr($fecha,3,2)-1; 
		$indice=0;
		$indice=$mes;
		$meses = array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN','JUL', 'AGO', 
		'SEP', 'OCT', 'NOV', 'DIC');
		
		return $meses[$indice].' '.substr($fecha,6,4);
	}
	
	function mesLetras($mes){
		$indice=ltrim($mes, "0");
		$meses = array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 
		'SEP', 'OCT', 'NOV', 'DEC' );  
		return $meses[$indice];
	}
	// ------------------------------------------------------------------------
	
	/**
		* Generates HTML DIV tags
		*
		* @access	public
		* @param	integer
		* @return	string
	*/
	function div($action = 0,$class = null, $id = null)
	{
		if(empty($action)){
			$output = "<div ";
			$output .= !empty($class)?"class='".$class."'":null;
			$output .= !empty($class)?"id='".$class."'":null;
			$output .= ">";
			}else{
			$output = "</div>";
		}
		return $output;
	}       
	
	function getAccesoSeccion($UXR_UCOD = null,$USD_ALIAS = null){
        $CI =& get_instance();
		$sql="SELECT USP_SECUENCIAL FROM VW_USUARIOSXDIRXPER WHERE USUARIO='$UXR_UCOD' AND ALIAS='$USD_ALIAS'";
        $value = $CI->db->query($sql)->row_array();
        if(!empty($value['USP_SECUENCIAL'])){
            return true;
			}else{
            return false;
		}
	}
	
	function procesarExcel($archivo = null){
		$CI =& get_instance();
		$CI->load->library('PHPExcel');
		//$CI->load->library('PHPExcel/IOFactory');
		$objPHPExcel = new PHPExcel();
		
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objReader->load($archivo);
		$objPHPExcel->setActiveSheetIndex(0);
		// Lee registros
		$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
		$filas=array();
		$i = 0;
		foreach($rowIterator as $row){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
            //   if(1 == $row->getRowIndex ()) continue;//skip first row
			foreach ($cellIterator as $cell) {
				$filas[$i][$cell->getColumn()]=trim($cell->getCalculatedValue());
			}
			$i++;
		}
		return $filas;
	}
	
	function generarEnlace($funcion=null){
		$server=$this->db->query("select PR_URL2 FROM F_PARAMETROS")->row();
		$rutaSinCodificar=$server->PR_URL2;
		$rutaACodificar = base64_encode($funcion);  
		return $rutaSinCodificar."varios/ruta/".$rutaACodificar;
	}
	
	function verificarCorreo($direccion)
	{
		$Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
		if(preg_match($Sintaxis,$direccion))
		return true;
		else
		return false;
	}
	
	//Funcion para encriptar la clave de acceso
	function encriptar($string) {
		$key='FACTURACION';
		$result = '';
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return base64_encode($result);
	}
	
	//Funcion para desencriptar la clave de acceso
	function desencriptar($string) {
		$key='FACTURACION';
		$result = '';
		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}	
	
	//Funcion multiseleccion	
	function pharseAmp($string = null){
		return empty($string)?null:utf8_decode(str_replace("&","&' || '",$string));
	}
	
	//Funcion para select en combo
	function select($name = 'cmb',$class=null,$data = null,$multiple = null,$number = 0){
		return "<select name='".$name."' id='".substr($name,0,$number)."' ".$multiple."  style='width:200px;' class='ui-widget ui-state-default ".$class."'>".$data."</select>";
	}
	
	//Funcion para establecer opcion	
	function option($selected = false, $value = null, $text = null){
		if (!isset($value)){
			return "<option value=''> ---- </option>";
		}
		if(empty($text)){
			$text = $value;
		}
		return "<option value='".prepCampoMostrar($value)."' . ".$selected.">".prepCampoMostrar($text)."</option>";		
	}
	
	//Funcion de numero a meses 	
	function numeroAMes($mesIn){
		if($mesIn<=12 and is_numeric($mesIn)){	
			$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");   
			return $meses[$mesIn-1];
			}else{
			return null;  	
		}  
	}
	
	//FUNCION PARA OBTENER CLAVE DE ACCESO
	function claveAcceso($fechaEmision=null,$tipoComprobante=null,$ruc=null,$ambiente=null,$numeroComprobante=null,$tipoEmision=null,$establecimiento=null,$puntoEmision=null){		
		if($establecimiento!=null and $puntoEmision!=null){
			$serie=$establecimiento.$puntoEmision;
		}else{
			$serie='001001';
		}		
		$codigoNumerico='12345678';
		$clave=$fechaEmision.$tipoComprobante.$ruc.$ambiente.$serie.completaNum($numeroComprobante).$codigoNumerico.$tipoEmision;
		$verificador=digitoVerificador($clave);
		$claveAcceso=$clave.$verificador;
		return $claveAcceso;
	}
	
	//Completa el numero si es necesario	
	function completaNum($numero=null){
		$cuenta=strlen($numero);
		if($cuenta<9){
			$num=str_pad($numero, 9, "0", STR_PAD_LEFT);
			}else{
			$num=$numero;
		}
		return $num;
	}	
	
	//FUNCION PARA OBTENER DIGITO VERIFICADOR DE CLAVE DE ACCESO
	function digitoVerificador($clave=null){
		$aux = str_split($clave);
		$baseMultiplicador = 7;
		$multiplicador = 2;
		$total = 0;
		$verificador = 0;
		for ($i = count($aux) - 1; $i>=0; $i--){
			$aux[$i]*=$multiplicador;
			$multiplicador++;
			if ($multiplicador>$baseMultiplicador) {
				$multiplicador = 2;
			}
			$total+=$aux[$i];
		}
		if (($total == 0) || ($total == 1)) {
			$verificador = 0;
			} else {
			$verificador = 11 - $total % 11 == 11 ? 0 : 11 - $total % 11;
		}		
		if ($verificador == 10) {
			$verificador = 1;
		}		
		return $verificador;
	}
	
	//funcion de forma de pagos
	function getFormaPago($formapago=null){
		switch ($formapago) {
			case "01":
			echo "SIN UTILIZACIÓN DEL SISTEMA FINANCIERO";
			break;
			case "15":
			echo "COMPENSACIÓN DE DEUDAS";
			break;
			case "16":
			echo "TARJETA DE DÉBITO";
			break;
			case "17":
			echo "DINERO ELETRÓNICO";
			break;
			case "18":
			echo "TARJETA PREPAGO";
			break;
			case "19":
			echo "TARJETA DE CRÉDITO";
			break;	
			case "20":
			echo "OTROS CON UTILIZACIÓN DEL SISTEMA FINANCIERO";
			break;
			case "21":
			echo "ENDOSO DE TÍTULOS";
			break;	
		}	
	}
	
	//funcion de ruta tipo
	function getTipo($tipo=0){
		$CI =& get_instance();
		switch ($tipo) {
			case 1: //GENERADOS
			return $CI->config->item('generados');
			break;
			case 2: //AUTORIZADOS
			return $CI->config->item('autorizados');
			break;
			case 3: //PENDIENTES
			return $CI->config->item('generados');
			break;
			case 4: //RECIBIDOS
			return $CI->config->item('otros');
			break;
			case 5: //DEVUELTO
			return $CI->config->item('noautorizados');
			break;
			case 6: //ERROR
			return $CI->config->item('noautorizados');
			break;	
			default: //OTROS
			return $CI->config->item('otros');
		}	
	}
	
	//Combo de presentacion empresas
	function comboArreglo($data,$nombre){	
		$CI =& get_instance();
		$empresa=$CI->session->userdata('EMPRESA');
		if($empresa==''){
			return "<font color='red'><B>"."Sin Empresas"."</B></font>";
			}else{
			if(!empty($data)){
				if(is_array($data)){
					$html_output='<select id="'.$nombre.'">';
					$i=null;
					foreach ($data as $d) {
						$selected= empty($i)?"selected":null;   
						$html_output.="<option {$selected} value='{$d}'>{$d}</option>";
						$i++;
					}
					$html_output.="</select>";
					}else{
					$html_output = $data;
				}
				return $html_output;
				}else{
				return "Sin Empresas";
			}
		}
	}
	
	//Funcion para devolver el numero de sustento
	function numeroSustento($numero){
		$primero = substr($numero, 0,3);
		$segundo = substr($numero, 3,3);
		$tercero = substr($numero, 6);
		$numSustento = $primero."-".$segundo."-".$tercero;
		return 	$numSustento;
	}
	
	//funcion de forma de pagos
	function getTipoDocumento($tipo=null){
		switch ($tipo) {
			case "01":
			echo "FACTURA";
			break;
			case "03":
			echo "LIQ. DE COMPRAS";
			break;
			case "04":
			echo "NOTA DE CRÉDITO";
			break;
			case "05":
			echo "NOTA DE DÉBITO";
			break;
			case "06":
			echo "GUÍA DE REMISIÓN";
			break;
			case "07":
			echo "COMPROBANTE DE RETENCIÓN";
			break;
			default:
			echo "OTROS";
		}	
	}
	
	//funcion de forma de pagos
	function getTipoImpuesto($impuesto=0){
		switch ($impuesto) {
			case 1:
			echo "RENTA";
			break;
			case 2:
			echo "I.V.A.";
			break;    
			default:
			echo "OTROS";
		}	
	}
	
	function getDireccion($DIRECCION=NULL,$COMPROBANTE=NULL,$FECHA=NULL){
		$PATH = $DIRECCION.$COMPROBANTE."/".$FECHA."/";
		if(!file_exists($PATH)){
			mkdir ($PATH, 0777, true);
		}
		return $PATH;
	}
	
	function change_key( $array, $old_key, $new_key ) {
		
		if( ! array_key_exists( $old_key, $array ) )
        return $array;
		
		$keys = array_keys( $array );
		$keys[ array_search( $old_key, $keys ) ] = $new_key;
		
		return array_combine( $keys, $array );
	}
	
	function buscaExtension($ruta){
		$rutaFinal=null;
		if(file_exists($ruta.".pdf")){
				$rutaFinal = $ruta.".pdf";
			}elseif(file_exists($ruta.".PDF")){
				$rutaFinal = $ruta.".PDF";
			}elseif(file_exists($ruta.".zip")){
				$rutaFinal = $ruta.".zip";
			}elseif(file_exists($ruta.".ZIP")){
				$rutaFinal = $ruta.".ZIP";	
			}elseif(file_exists($ruta.".rar")){
				$rutaFinal = $ruta.".rar";		
			}elseif(file_exists($ruta.".RAR")){
				$rutaFinal = $ruta.".RAR";
			}elseif(file_exists($ruta.".doc")){
				$rutaFinal = $ruta.".doc";
			}elseif(file_exists($ruta.".DOC")){
				$rutaFinal = $ruta.".DOC";
			}elseif(file_exists($ruta.".xls")){
				$rutaFinal = $ruta.".xls";
			}elseif(file_exists($ruta.".XLS")){
				$rutaFinal = $ruta.".XLS";
			}elseif(file_exists($ruta.".docx")){
				$rutaFinal = $ruta.".docx";
			}elseif(file_exists($ruta.".DOCX")){
				$rutaFinal = $ruta.".DOCX";
			}elseif(file_exists($ruta.".XLSX")){
				$rutaFinal = $ruta.".XLSX";
			}elseif(file_exists($ruta.".png")){
				$rutaFinal = $ruta.".png";	
			}elseif(file_exists($ruta.".PNG")){
				$rutaFinal = $ruta.".PNG";
			}elseif(file_exists($ruta.".jpg")){
				$rutaFinal = $ruta.".jpg";	
			}elseif(file_exists($ruta.".JPG")){
				$rutaFinal = $ruta.".JPG";
			}elseif(file_exists($ruta.".jpeg")){
				$rutaFinal = $ruta.".jpeg";
			}elseif(file_exists($ruta.".JPEG")){
				$rutaFinal = $ruta.".JPEG";	
			}else{
			$rutaFinal = null;
		}
		return $rutaFinal;
	}
	
	function ultimoDia($anio=0,$mes=0) { 
		$month = $mes;
		$year = $anio;
		return date("d",(mktime(0,0,0,$month+1,1,$year)-1));
	};
	
	function diamas($fecha, $cuantos) {
   $partes = explode("-", $fecha);
   $ano = $partes[0] + 0;
   $mes = $partes[1] + 0;
   $dia = $partes[2] + 0;
   $diamas = mktime(date(0), date(0), date(0), date($mes), date($dia) + $cuantos, date($ano));
   return date("Y-m-d", $diamas);
}

function mesmas($fecha, $cuantos) {
   $partes = explode("-", $fecha);
   $ano = $partes[0] + 0;
   $mes = $partes[1] + 0;
   $dia = $partes[2] + 0;
   $diamas = mktime(date(0), date(0), date(0), date($mes) + $cuantos, date($dia), date($ano));
   return date("Y-m", $diamas);
}

function getUltimoDiaMes($fecha) {
   $partes = explode("-", $fecha);
   $ano = $partes[0] + 0;
   $mes = $partes[1] + 0;
  return date("d",(mktime(0,0,0,$mes+1,1,$ano)-1));
}

//Funcion para obtener la desviacion estandar	
	function stats_standard_deviation(array $a, $sample = false) {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
		}
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
		}
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
		};
        if ($sample) {
			--$n;
		}
        return sqrt($carry / $n);
	}
	
//Numero de dias	
function diferenciaDias($inicio, $fin){
	$inicio = strtotime($inicio);
	$fin = strtotime($fin);
	$dif = $fin - $inicio;
	$diasFalt = (( ( $dif / 60 ) / 60 ) / 24);
	return ceil($diasFalt);
}

//Formula para calculo impuesto a la renta
function impuestoRenta($BASEIMPUESTO=0,$ANIO=0){
	//CALCULO IMPUESTO A LA RENTA POR PAGAR
	if($BASEIMPUESTO!=0 and $ANIO!=0){
		$CI =& get_instance();
		$SQLCONSULIR="select * from IMPUESTORENTA 
						WHERE IR_PERIODO=TO_DATE('{$ANIO}/01/01','YYYY/MM/DD')
						and IR_ESTADO=0
						and {$BASEIMPUESTO} between IR_FRACCION_BASICA and IR_EXCESO_HASTA";
		$CONSULTABLAIR=$CI->db->query($SQLCONSULIR)->row();
		$IRXPAGAR=0;
		if(!empty($CONSULTABLAIR)){
			
			$BASEIFB=$BASEIMPUESTO-($CONSULTABLAIR->IR_FRACCION_BASICA);
												
			$PORCENTAJEFX=(($BASEIFB*($CONSULTABLAIR->IR_POR_IMP_FRACCION_EXCEDENTE))/100);
			
			$IMPFRACCIONBAS=$CONSULTABLAIR->IR_IMP_FRACCION_BASICA;
			
			$IRXPAGAR=$PORCENTAJEFX+$IMPFRACCIONBAS;									
			
		}else{
			$IRXPAGAR=0;
		}
	}else{
		$IRXPAGAR=0;
	}
	return $IRXPAGAR;
}

?>
