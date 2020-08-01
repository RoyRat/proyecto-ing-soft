<?php
class Mcorreo extends CI_Model {
    	  
	//Mail de envio Crea persona
	function mailCreaPersona($datos=null){			
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
				$mail->addAddress($datos['correoUsuario']);
		
				$subject = utf8_decode('Correo Registro ANALISIS');
				$clavemsj= "<B>Clave Temporal: </B>".$datos['claveTemp']."<br><br>";
				$pagina="<a style='color:#4257F9' href='".@$this->config->item('enlaceSistema')."'>"."www.madeinbarter.com</a>"."<br><br>";
					$mensaje = "<h3> Estimado/a, 
								<br>Usuario<br><br>
								A continuaci&oacute;n termine el registro con los datos siguientes:<br> 
								<br>E_mail: ".$datos['correoUsuario']
								."<br>".$clavemsj."<br>"
								."Referido Por: ".$datos['referido']."<br>"
								."Ingresando en la siguiente p&aacute;gina: ".$pagina;
					$mail->Subject = $subject;
					$mail->msgHTML($mensaje);	
					if (!$mail->send()) {
						return 1;
					} else {
						return 0;
					}		
	}
	
	//Mail de envio confirmacion persona
	function mailConfirmaPersona($datos=null){			
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
				$mail->addAddress($datos['correoUsuario']);				
		
				$subject = utf8_decode('Confirmación, ANALISIS');
				$pagina="<a style='color:#4257F9' href='".@$this->config->item('enlaceSistema')."'>"."www.madeinbarter.com</a>"."<br><br>";
					$mensaje = "<h3> Estimado/a, 
								<br>".utf8_encode($datos['nombresUsuario'])."<br><br>
								Su registro fue exitoso<br> 
								<br>E_mail: ".$datos['correoUsuario']."<br>"."Puede Ingresar en la siguiente p&aacute;gina: ".$pagina;
					$mail->Subject = $subject;
					$mail->msgHTML($mensaje);	
					if (!$mail->send()) {
						return 1;
					} else {
						return 0;
					}		
	}
	
	//Mail de envio confirmacion cambio de clave
	function mailConfirmaClave($datos=null){			
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
				$mail->addAddress($datos['correoUsuario']);				
		
				$subject = utf8_decode('Cambio de Clave, ANALISIS');
				$pagina="<a style='color:#4257F9' href='".@$this->config->item('enlaceSistema')."'>"."www.madeinbarter.com</a>"."<br><br>";
					$mensaje = "<h3> Estimado/a, 
								<br>".utf8_encode($datos['nombresUsuario'])."<br><br>
								Su cambio de clave fue exitoso<br>
								Si usted no realizo esta acción, favor cominiquese con soporte<br>		
								<br>E_mail: ".$datos['correoUsuario']."<br>"."Puede Ingresar en la siguiente p&aacute;gina: ".$pagina;
					$mail->Subject = $subject;
					$mail->msgHTML($mensaje);	
					if (!$mail->send()) {
						return 1;
					} else {
						return 0;
					}		
	}
	
	//Mail de envio anulacion de cuenta
	function mailConfirmaAnula($datos=null){			
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
				$mail->addAddress($datos['correoUsuario']);				
		
				$subject = utf8_decode('Correo Anulación, ANALISIS');
				$pagina="<a style='color:#4257F9' href='".@$this->config->item('enlaceSistema')."'>"."www.madeinbarter.com</a>"."<br><br>";
					$mensaje = "<h3> Estimado/a, 
								<br>".utf8_encode($datos['nombresUsuario'])."<br><br>
								Lamentamos su decisión, estaremos prestos para otra ocasión<br>
								Si usted no realizo esta acción o desea regresar, favor cominiquese con soporte"."<br>"."Puede Ingresar en la siguiente p&aacute;gina: ".$pagina;
					$mail->Subject = $subject;
					$mail->msgHTML($mensaje);	
					if (!$mail->send()) {
						return 1;
					} else {
						return 0;
					}		
	}
	
function mailPrueba(){
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
				$mail->addAddress('asist.sistemas@cruzrojainstituto.edu.ec');	
				$subject = utf8_decode('Prueba SISTEMAS MAIL');
				$mensaje = "Prueba de Correo,";
				$mail->Subject = $subject;
				$mail->msgHTML($mensaje);
				if (!$mail->send()) {
						return $mail->ErrorInfo;
					} else {
						return 1;
					}	
}	

//Mensaje de confirmacion ruta del servidor
function genEnlace($funcion=null){
         $rutaSinCodificar=$this->config->item('enlaceSistema');
         $rutaACodificar = urlencode(base64_encode($funcion));
         return $rutaSinCodificar."/usuario/ruta/".$rutaACodificar;
      }
	
function mailReset($codigo,$resetclave=0){
	$sql = "SELECT USUARIO.*, STR_TO_DATE(DATE_FORMAT(SYSDATE(),'%d/%m/%Y %H:%i:%s'),'%d/%m/%Y %H:%i:%s') FECHA FROM USUARIO WHERE US_SECUENCIAL=".$codigo."";
	$r=  $this->db->query($sql)->row_array();
	$funcion="mostrarformularioReset--".$r['US_CODIGO']."--".$r['FECHA'];
	$enlace = $this->genEnlace($funcion);
	$enlaceUrl="<a style='color:#3FB707' href='".$enlace."'><B>LINK PARA CAMBIAR CLAVE</B></a>";
	
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
				$mail->addAddress($r['US_MAIL']);
				
	
	if ($resetclave==1){
		
		$subject = "ANALISIS reseto de Clave";
		$mensaje = "<h3> Estimado/a " .  utf8_encode($r['US_NOMBRES']) ."</h3><hr><br><br>"
                   ."Este mail ha sido enviado automáticamente en repuesta a su requerimiento de reseteo de clave."."<br>"
                   ."Para resetear la clave, presione click en el siguiente enlace.".'<br><br>'.
                   $enlaceUrl.'<br><br>
				   Esta es una notificación automática de nuestro sistema por favor no la responda, no hay un ser humano que procese esta notificación.<br>
				   Gracias.';
	}else{
		$subject = "ANALISIS reseto de Clave";
		$mensaje = "<h3> Estimado/a " .  utf8_encode($r['US_NOMBRES']) ."</h3><hr><br><br>"
                   ."Este mail ha sido enviado automáticamente en repuesta al requerimiento de creación de su usuario."."<br>"
                   ."Su código de usuario es: <b>".$r['US_CODIGO'].")</b><br>"
                   ."Para ingresar la clave en su cuenta, presione click en el siguiente enlace.".'<br><br>'.
                   $enlaceUrl.'<br><br>
				   Esta es una notificación automática de nuestro sistema por favor no la responda, no hay un ser humano que procese esta notificación.<br>
				   Gracias.';
	}
	
	$mail->Subject = $subject;
	$mail->msgHTML($mensaje);
	
	if (!$mail->send()) {
		return $mail->ErrorInfo;
	} else {
		return 1;
	}
}

//Mensaje de confirmacion ruta del servidor
function genEnlaceConfirma($funcion=null){
         $rutaSinCodificar=$this->config->item('enlaceSistema');
         $rutaACodificar = urlencode(base64_encode($funcion));
         return $rutaSinCodificar."/cesta/ruta/".$rutaACodificar;
      }
	  
//Mail de cliente
	function mailCompraCliente($datosCliente=null,$datosVendedor=null){
	
	/*$funcion="finalizaCompraCliente--".$datosCliente['secCesta']."--".$datosCliente['secCliente'];
	$enlace = $this->genEnlaceConfirma($funcion);
	$enlaceUrl="<a style='color:#3FB707' href='".$enlace."'><B>CONFIRMA TU COMPRA</B></a>";*/
	
	$funcion="CancelarCompraCliente--".$datosCliente['secCesta']."--".$datosCliente['secCliente'];
	$enlace = $this->genEnlaceConfirma($funcion);
	$enlaceUrlCancela="<a style='color:#E90606' href='".$enlace."'><B>CANCELAR COMPRA</B></a>";
	
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
				$mail->addAddress($datosCliente['correoComprador']);				
		
				$subject = utf8_decode('Correo Registro Made In BARTER');
				//$clavemsj= utf8_decode("<B>Clave Para Confirmación: </B>".$datosCliente['claveProducto']."<br><br>");
				$clavemsj= utf8_decode("Clave De Confirmación: <b><font color='##08BD17'>".$datosCliente['claveProducto']."</font></b>. <br>NOTA: Si Tu Compra Fue Satisfactoria, Entrega La Clave Al Vendedor.");
				$pagina="<a style='color:#4257F9' href='".@$this->config->item('enlaceSistema')."'>"."www.madeinbarter.com</a>"."<br><br>";
					$mensaje = "<h3> Estimado/a, 
								<br>".utf8_encode($datosCliente['nombreComprador'])."<br><br>
								A continuaci&oacute;n termine su compra contactandose con el vendedor:<br>".
								"<br>Producto: ".utf8_encode($datosVendedor['productoProveedor']).
								"<br>Vendedor: ".utf8_encode($datosVendedor['nombresProveedor']).
								"<br>Correo: ".utf8_encode($datosVendedor['correoProveedor']).
								"<br>Direcci&oacute;n: ".utf8_encode($datosVendedor['direccionProveedor']).
								"<br>Celular: ".$datosVendedor['celularProveedor'].
								"<br>Convencional: ".$datosVendedor['convencionalProveedor'].
								"<br>".$clavemsj."<br>"
								."<br>Cancela Tu Compra En El Siguiente Enlace: ".$enlaceUrlCancela;
					$mail->Subject = $subject;
					$mail->msgHTML($mensaje);	
					if (!$mail->send()) {
						return 1;
					} else {
						return 0;
					}
	}
	
//Mail de proveedor
	function mailCompraVendedor($datosCliente=null,$datosVendedor=null){
	
				$funcion="finalizaCompraVendedor--".$datosCliente['secCesta']."--".$datosCliente['secCliente'];
				$enlace = $this->genEnlaceConfirma($funcion);
				$enlaceUrl="<a style='color:#3FB707' href='".$enlace."'><B>CONFIRMA TU VENTA</B></a>";
				
				$funcion="CancelarCompraVendedor--".$datosCliente['secCesta']."--".$datosCliente['secCliente'];
				$enlace = $this->genEnlaceConfirma($funcion);
				$enlaceUrlCancela="<a style='color:#E90606' href='".$enlace."'><B>CANCELAR VENTA</B></a>";
	
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
				$mail->addAddress($datosVendedor['correoProveedor']);				
		
				$subject = utf8_decode('Correo Registro Made In BARTER');
				//$clavemsj= utf8_decode("<B>Clave Para Confirmación: </B>".$datosCliente['claveProducto']."<br><br>");
				$clavemsj= utf8_decode("<B>Clave De Confirmación, Se La Proveera El Comprador <br><br>");
				$pagina="<a style='color:#4257F9' href='".@$this->config->item('enlaceSistema')."'>"."www.madeinbarter.com</a>"."<br><br>";
					$mensaje = "<h3> Estimado/a, 
								<br>".utf8_encode($datosVendedor['nombresProveedor'])."<br><br>
								A continuaci&oacute;n termine su venta contactandose con el comprador:<br>".
								"<br>Producto: ".utf8_encode($datosVendedor['productoProveedor']).
								"<br>Comprador: ".utf8_encode($datosCliente['nombreComprador']).
								"<br>Correo: ".utf8_encode($datosCliente['correoComprador']).
								"<br>Direcci&oacute;n: ".utf8_encode($datosCliente['direccionComprador']).
								"<br>Celular: ".$datosCliente['celularComprador'].
								"<br>Convencional: ".$datosCliente['convencionalComprador'].
								"<br>".$clavemsj."<br>"
								."Confirma Tu Venta En El Siguiente Enlace: ".$enlaceUrl."<br>"
								."<br>Cancela Tu Venta En El Siguiente Enlace: ".$enlaceUrlCancela;
					$mail->Subject = $subject;
					$mail->msgHTML($mensaje);	
					if (!$mail->send()) {
						return 1;
					} else {
						return 0;
					}
	}
	
}
?>

