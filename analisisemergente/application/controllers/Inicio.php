<?php
class Inicio extends  CI_Controller  {
	
	public function __construct (){
		parent::__construct();
                $this->load->model('mvarios');
                
	}
	
        public function vacio(){
            $datos['cambiopassword']=$this->mvarios->validaClave($this->session->userdata('US_CODIGO'));
            if ($datos['cambiopassword']>0){
                $datos['US_CODIGO'] =$this->session->userdata('US_CODIGO');
                $this->load->view('general/usu_frmPass',$datos);
            } else {
              return null;
            }
        }
	
        public function index (){
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			clearstatcache();
            if ($this->session->userdata('logged_in')==true)  {
            	if(($this->session->userdata('ESTADO')==false) and ($this->session->userdata('PERFIL_ESTADO')==false)){
		 		$d['contenido'] = $this->load->view('general/main_form', null, true);
		 		$this->load->view('general/principal', $d);
                        }else{
                                $data['message'] = "El usuario o el perfil está bloqueado; por favor, contacte al administrador.";
                                $this->load->view('general/login_form',$data);
                        }
            } else {
                $data['message'] = "";
                $this->load->view('general/login_form',$data);
            }
        }
	public function enconstruccion(){
		$this->load->view('general/enconstruccion_v');
	}
	
	public function salir(){
	  $this->session->sess_destroy();
	  redirect('general/inicio');
	}
        
      function ruta($urlEncoded){
        $this->load->model('maprobar'); 
      //  $function = explode("--",base64_decode($urlEncoded));
          $function = explode("--",$urlEncoded);
  	echo $this->$function[0]->$function[1]($function[2],$function[3],$function[4]);
      }


function enviaCodigoCorreo(){	
	$USER=$this->input->post('USER');
	$CLAVE=$this->input->post('CLAVE');
	$epassword=encriptar($CLAVE);
	$CI =& get_instance();
	
	$SQLUSER="SELECT US_SECUENCIAL, US_CODIGO,
				CONCAT(US_NOMBRES,' ',US_APELLIDOS) US_NOMBRES,
				US_SIGLAS,US_MAIL
				FROM USUARIO 
				WHERE UPPER(US_CODIGO)=UPPER('{$USER}') 
				AND US_CLAVE='{$epassword}'";
	$USUARIO=$CI->db->query($SQLUSER)->row();
	if(!empty($USUARIO)){
		$SIGLAS=$USUARIO->US_SIGLAS;
		$NOMBRES=$USUARIO->US_NOMBRES;
		$MAIL=$USUARIO->US_MAIL;
		$ALEATORIO=rand(0001,9999);
		$CODIGO_VERIFICACION=$SIGLAS.$ALEATORIO;
		$ecodverifica=encriptar($CODIGO_VERIFICACION);
			//CAMBIO DE CODIGO VERIFICACION
			$SQLUPDATEUSER="UPDATE USUARIO SET
								US_COD_VERIFICA='{$ecodverifica}'
							WHERE UPPER(US_CODIGO)=UPPER('{$USER}')
							AND US_CLAVE='{$epassword}'";
			$CI->db->query($SQLUPDATEUSER);
				
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = 1;
				$mail->Debugoutput = 'html';
				$mail->Host =@$this->config->item('anfitrion');
				$mail->Port =@$this->config->item('puerto');
				$mail->Username =@$this->config->item('usuario');
				$mail->Password =@$this->config->item('clave');
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'ssl';
				$mail->setFrom(@$this->config->item('correoSistema'),utf8_decode(@$this->config->item('usuarioSistema')));
				$mail->addReplyTo(@$this->config->item('correoSistema'),utf8_decode(@$this->config->item('usuarioSistema')));
				$mail->addAddress($MAIL);
				$fechaNormal = @date("d-m-Y");
				
				$subject = utf8_decode('SISTEMA DE CONFIRMACIÓN');
				$mensaje = "<h3> Estimado/a " .strtoupper(html_entity_decode($NOMBRES))."</h3><hr><br>"
                   .html_entity_decode("Gracias por confiar en nuestro servicio.<br><br>
						Confirmamos tu ingreso satisfactorio ".$fechaNormal."<br><br>
						<br><br>
						CÓDIGO DE VERIFICACIÓN: <font color='#F40105'><b>".utf8_encode($CODIGO_VERIFICACION)."</b></font><br><br>
						<br><br>
						<hr>
						Este mail ha sido enviado automáticamente por el Sistema, Por favor no responder.");
				$mail->Subject = $subject;
				$mail->msgHTML($mensaje);
				if (!$mail->send()) {
						echo $mail->ErrorInfo;
					} else {
						echo 0;
					}		
	}else{
		echo 1;
	}
}
	
}
