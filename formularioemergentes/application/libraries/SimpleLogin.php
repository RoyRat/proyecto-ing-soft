<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Simplelogin
{

	function Simplelogin(){}

	function login($user = '', $password = '') {

		$CI =& get_instance();

		if($user == '' OR $password == '') {
			return false;
		}

	     $epassword=$this->encriptar($password);
		 $user=utf8_decode($user);

		$sql="SELECT US_CODIGO, US_NOMBRES, 
							(SELECT NVL(COUNT(*),0) FROM ISTCRE_APLICACIONES.VW_USUARIOSXDIRXPER WHERE ALIAS='ADM' AND APLICACION='LOGISTICO_APP' AND USUARIO=UPPER('{$user}')) US_ADMINISTRADOR, 
							(SELECT NVL(COUNT(*),0) FROM ISTCRE_APLICACIONES.VW_USUARIOSXDIRXPER WHERE ALIAS='ADMS' AND APLICACION='LOGISTICO_APP' AND USUARIO=UPPER('{$user}')) US_ADMSISTEMAS, 
							(SELECT NVL(COUNT(*),0) FROM ISTCRE_APLICACIONES.VW_USUARIOSXDIRXPER WHERE ALIAS='USR' AND APLICACION='LOGISTICO_APP' AND USUARIO=UPPER('{$user}')) US_USUARIO, 
							ACC_PERFIL US_NOMBRE_PERFIL 
						FROM ISTCRE_APLICACIONES.VW_USUARIO 
						WHERE US_ESTADO=0 
							AND ACC_ESTADO=0 
							AND US_APLICACION='LOGISTICO_APP' 
							AND US_CODIGO=UPPER('{$user}')
							AND US_CLAVE='{$epassword}'";	
            
            $usuario = $CI->db->query($sql)->row_array();

		if (count($usuario)>0) {
			//Destroy old session
                    
			$CI->session->sess_destroy();
			
			//Create a fresh, brand new session
			$CI->session->sess_create();
			
			//Remove the password field
			unset($usuario['clave']);
			
			//Set session data
			$CI->session->set_userdata($usuario);
			
			//Set logged_in to true
			$CI->session->set_userdata(array('logged_in' => true));			

                        $v=$CI->session->userdata('logged_in');
                        print ($v);
			//Login was successful	
			return true;
		} else {
                    
			//No database result found
			return false;
		}	

	}
	
	function encriptar($string) {
	$key='ISTCRE_GEST_APP';
	$result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}
	
	function logout() {
		//Put here for PHP 4 users
		$CI =& get_instance();		

		//Destroy session
		$CI->session->sess_destroy();
	}

        function verificaclave($clave,$user){
             $CI =& get_instance();
              $epassword=$this->encriptar($clave);
              $sql = "SELECT ISNULL(count(*),0) NRO FROM ISTCRE_APLICACIONES.VW_USUARIO WHERE US_CLAVE='$epassword' and US_CODIGO='$user'";
	      $usuario = $CI->db->query($sql)->row();
              print $usuario->NRO;
        }

        function grabarclave($clave,$user){
              $CI =& get_instance();
              $epassword=$this->encriptar($clave);
              $sql = "update ISTCRE_APLICACIONES.usuario set US_CLAVE='$epassword' where US_CODIGO='$user'";
	      $CI->db->query($sql);
		  sleep(3);
              //verificar si se actualizado
              $sql2 = "SELECT ISNULL(count(*),0) NRO FROM ISTCRE_APLICACIONES.VW_USUARIO WHERE US_CLAVE='$epassword' and US_CODIGO='$user'";
	      $usuario = $CI->db->query($sql2)->row();
              return $usuario->NRO;
        }
}
?>