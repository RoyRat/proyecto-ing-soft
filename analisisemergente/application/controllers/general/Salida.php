<?php
class Salida extends CI_Controller  {
	
	public function __construct (){
		parent::__construct();
	}
	
	public function index (){
		$this->load->library('SimpleLogin');
		$this->load->view("logout_form");
		if($this->input->post('logout')) {
			 $loginsistema = new SimpleLogin();
			 $loginsistema->logout();
			 $this->load->view("fin_form");
		}
	}
}	
?>
