<?php
class Inicio extends  CI_Controller  {
	
	public function __construct (){
		parent::__construct();
                $this->load->model('mvarios');
                
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
	        
      function ruta($urlEncoded){
        $this->load->model('maprobar'); 
      //  $function = explode("--",base64_decode($urlEncoded));
          $function = explode("--",$urlEncoded);
  	echo $this->$function[0]->$function[1]($function[2],$function[3],$function[4]);
      }
  
	
}
