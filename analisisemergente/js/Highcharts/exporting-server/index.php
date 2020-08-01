<?php
/**
 * Este archivo es parte del módulo de exportación para Highcharts JS.
 * www.highcharts.com/license
 * 
 *  
 * Available POST variables:
 *
 * $filename  string   El nombre del archivo deseado sin extensión
 * $type      string   El tipo MIME para la exportación.
 * $width     int      El ancho de píxel de la imagen de trama exportado. Se calcula la altura.
 * $svg       string   El código fuente SVG para convertir.
 */


// Opciones
define ('BATIK_PATH', 'batik-rasterizer.jar');
define ('TEMP_PATH', 'temp/');//Path para las imagenes de descarga

///////////////////////////////////////////////////////////////////////////////
ini_set('magic_quotes_gpc', 'off');

$type = $_POST['type'];
$svg = (string) $_POST['svg'];
$filename = (string) $_POST['filename'];

// prepara variables
if (!$filename) $filename = 'chart';
if (get_magic_quotes_gpc()) {
	$svg = stripslashes($svg);	
}



$tempName = !empty ($filename) ? $filename : "Grafico";

// permite solo formatos configurados
if ($type == 'image/png') {
	$typeString = '-m image/png';
	$ext = 'png';
	
} elseif ($type == 'image/jpeg') {
	$typeString = '-m image/jpeg';
	$ext = 'jpg';

} elseif ($type == 'application/pdf') {
	$typeString = '-m application/pdf';
	$ext = 'pdf';

} elseif ($type == 'image/svg+xml') {
	$ext = 'svg';	
}
$outfile = TEMP_PATH."$tempName.$ext";

if (isset($typeString)) {
	
	// tamaño
	if ($_POST['width']) {
		$width = (int)$_POST['width'];
		if ($width) $width = "-w $width";
	}

	// generar archivo
	if (!file_put_contents(TEMP_PATH."$tempName.svg", $svg)) { 
		die("No se ha podido crear el archivo temporal: ".TEMP_PATH.". <br>Compruebe que los permisos del directorio esten adecuados, directorio tempotal se establece en 777.");
	}
	
	// realiza la conversión
	shell_exec("chmod 777".TEMP_PATH."$tempName.svg");
	$output = shell_exec("java -jar ". BATIK_PATH ." $typeString -d $outfile $width".TEMP_PATH."$tempName.svg");
		 
	// error de captura
	if (!is_file($outfile) || filesize($outfile) < 10) {
		echo "<pre>$output</pre>";
		echo "Error al convertir SVG.";
		
		if (strpos($output, 'SVGConverter.error.while.rasterizing.file') !== false) {
			echo "Código SVG para la depuración: <hr/>";
			echo htmlentities($svg);
		}
	} 	
	// visualiza
	else {		
		header("Content-Disposition: attachment; filename=\"$filename.$ext\"");
		header("Content-Type: $type");
		echo file_get_contents($outfile);
	}
	
	// Borra temporales
	unlink(TEMP_PATH."$tempName.svg");
	//unlink($outfile);

// SVG se puede transmitir directamente de nuevo
} else if ($ext == 'svg') {
	header("Content-Disposition: attachment; filename=\"$filename.$ext\"");
	header("Content-Type: $type");
	echo $svg;	
} else {
	echo "Tipo Invalido";
}
?>
