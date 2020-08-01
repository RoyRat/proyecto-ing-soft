<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lib_usuarios {
    
    public function check(){
        $CI =& get_instance();
        if (($CI->session->userdata('logged_in')!=true) and ($CI->session->userdata('UXR_ESTADO')!=false) and ($CI->session->userdata('UXR_RSEC')!=false)) {
            $CI->session->set_flashdata('message', 'Acceso Denegado');
            redirect('inicio/');
        }
    }
    
    private function getUsuarioPerfil($US_CODIGO = null){
        $CI =& get_instance();
        return $CI->db->select("UXR_RSEC")
                      ->where("UXR_UCOD = '{$US_CODIGO}'")
                      ->get("USUARIOSXROLES")
                      ->row()->UXR_RSEC;
    }
    
     public function getAccesoSeccion($UXR_UCOD = null,$USD_ALIAS = null){
        $CI =& get_instance();
		$sql="SELECT USP_SECUENCIAL FROM ISTCRE_APLICACIONES.VW_USUARIOSXDIRXPER WHERE APLICACION='LOGISTICO_APP' AND USUARIO='$UXR_UCOD' AND ALIAS='$USD_ALIAS'";
        $value = $CI->db->query($sql)->row_array();
        if(!empty($value['USP_SECUENCIAL'])){
            return true;
        }else{
            return false;
        }
    }
    public function getElementoAcceso($US_CODIGO = null,$USD_SECUENCIAL = null){
        $UXR_RSEC = $this->getUsuarioPerfil($US_CODIGO);
        $CI =& get_instance();
        $value = $CI->db->select("USP_ELEMENTO")
                 ->where("USP_SECPERFIL = {$UXR_RSEC} AND USP_SECDIRECTIVA = {$USD_SECUENCIAL} AND USP_ESTADO = 0")
                 ->get("PERMISOS")
                 ->row_array();
		
        if(!empty($value['USP_ELEMENTO'])){
            return $value['USP_ELEMENTO'];
        }else{
            return false;
        }
    } 
 }

?>