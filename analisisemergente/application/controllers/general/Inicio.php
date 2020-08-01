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
  
	
}
