<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Simplelogin
{

	function Simplelogin(){}

	function login($user = '', $password = '') {

		$CI =& get_instance();

		if($user == '' OR $password == '') {
			return false;
		}

	     $epassword=encriptar($password);
		 $user=utf8_decode($user);

		$sql="SELECT US_CODIGO, US_NOMBRES, 
							(SELECT IFNULL(COUNT(*),0) FROM VW_USUARIOXDIRXPER WHERE ALIAS='ADM' AND APLICACION='APP_GESTOR' AND USUARIO=(SELECT US_SECUENCIAL FROM USUARIO WHERE US_CODIGO=UPPER('{$user}'))) US_ADMINISTRADOR, 
							(SELECT IFNULL(COUNT(*),0) FROM VW_USUARIOXDIRXPER WHERE ALIAS='ADMS' AND APLICACION='APP_GESTOR' AND USUARIO=(SELECT US_SECUENCIAL FROM USUARIO WHERE US_CODIGO=UPPER('{$user}'))) US_ADMSISTEMAS, 
							(SELECT IFNULL(COUNT(*),0) FROM VW_USUARIOXDIRXPER WHERE ALIAS='CONS' AND APLICACION='APP_GESTOR' AND USUARIO=(SELECT US_SECUENCIAL FROM USUARIO WHERE US_CODIGO=UPPER('{$user}'))) US_USUARIO, 
							ACC_PERFIL US_NOMBRE_PERFIL 
						FROM VW_USUARIO 
						WHERE US_ESTADO=0 
							AND ACC_ESTADO=0 
							AND US_APLICACION='APP_GESTOR'
							AND UPPER(US_CODIGO)=UPPER('{$user}')
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
	
	function logout() {
		//Put here for PHP 4 users
		$CI =& get_instance();		

		//Destroy session
		$CI->session->sess_destroy();
	}

        function verificaclave($clave,$user){
             $CI =& get_instance();
              $epassword=encriptar($clave);
              $sql = "SELECT IFNULL(count(*),0) NRO 
						FROM VW_USUARIO 
						WHERE US_CLAVE='$epassword' 
						and UPPER(US_CODIGO)=UPPER('$user')";
			  $usuario = $CI->db->query($sql)->row();
              print $usuario->NRO;
        }

        function grabarclave($clave,$user){
              $CI =& get_instance();
              $epassword=encriptar($clave);
              $sql = "UPDATE USUARIO SET US_CLAVE='$epassword' WHERE US_CODIGO='$user'";
	      $CI->db->query($sql);
		  sleep(3);
              //verificar si se actualizado
              $sql2 = "SELECT IFNULL(count(*),0) NRO 
						FROM VW_USUARIO 
						WHERE US_CLAVE='$epassword' 
						and UPPER(US_CODIGO)=UPPER('$user')";
	      $usuario = $CI->db->query($sql2)->row();
              return $usuario->NRO;
        }
}
?>