<?php
class Verificar_sesion extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->lib_usuarios->check();
    }
    
    function index(){
        if($this->session->userdata('logged_in')){
        	echo json_encode(array('estaActivo' => 1, 'mensaje' => 'OK'));
        }else{
        	echo json_encode(array('estaActivo' => 0, 
            'mensaje' => 'Sesión de usuario terminada. \n El sistema se cerrará...'));
        }
    }
}
