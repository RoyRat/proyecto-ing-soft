<?php
class Usuarios extends CI_Controller  {
	
	public function __construct (){
                parent::__construct();
                $this->lib_usuarios->check();
                $this->load->model("musuarios");
	}
	
     function clave(){
          $datos['US_CODIGO'] =$this->session->userdata('US_CODIGO');
          $datos['cambiopassword'] =0;
          $this->load->view("general/usu_frmPass", $datos, false);
      }
      
      function GrbFrmPrtPass(){
         $this->musuarios->GrbFrmPrtPass();
      }
}	
?>
