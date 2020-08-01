<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ingreso extends CI_Controller  {
	
       public $loginsistema;
       
       
	public function __construct (){
		parent::__construct();
                $this->load->library('form_validation');
                $this->load->library('SimpleLogin');
                $this->loginsistema=new SimpleLogin();
                
	}
        
        
	
	public function login (){
	  //aplicamos reglas
	  $this->form_validation->set_rules('user_name', 'Usuario', 'required');
	  $this->form_validation->set_rules('user_pass', 'Clave', 'required');
	  //delimitadores
	  $this->form_validation->set_error_delimiters('<em>','</em>');
	  if($this->input->post('login')) {		  
	    if($this->form_validation->run()){
	      $user_name = strtoupper($this->input->post('user_name'));
	      $user_pass = $this->input->post('user_pass');
	      if($this->loginsistema->login($user_name, $user_pass)){
		  // user has been logged in
		  //$this->loginsistema->leeparametros($this->session->userdata('LOCALIDAD'));
		    redirect('');
	      }else{
	      //$this->loginsistema->leeparametros($this->session->userdata('LOCALIDAD'));
		$this->session->set_flashdata('message', 'Usuario o Clave Incorrecta');
		redirect('');
		//redirect('inicio/index/');
		       }
	      }else{
		$this->session->set_flashdata('message', 'Usuario o Clave Incorrecta');
		redirect('');
	      }
	  }
	  $this->load->view("general/login_form");
	}

        
	public function salida (){
            $this->loginsistema->logout();
	}

        public function parametros (){          
          $this->load->view('general/logout_form');
        }

        public function fmain (){
          $this->load->view('general/main_form');
        }


        public function verificaclave(){
              $clave=$this->input->post('clave');
              $user=$this->session->userdata('US_CODIGO');
              return $this->loginsistema->verificaclave($clave,$user);              
        }

        public function grabarclave() {
              $clave=$this->input->post('clave');
              $user=$this->session->userdata('US_CODIGO');
              return $this->loginsistema->grabarclave($clave,$user);
        }
        

    }
?>