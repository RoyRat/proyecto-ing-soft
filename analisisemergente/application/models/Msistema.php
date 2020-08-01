<?php
class Msistema extends CI_Model {
   
   //Funcion en la cual muestra cada seleccion que ingresemos
   function getdatosItems(){
        $datos = new stdClass();
        $consulta=$_POST['_search'];
        $numero=  $this->input->post('numero');
        $datos->econdicion =' APP_ESTADO<>2';
              if (!empty($numero)){
                  $datos->econdicion .=" AND APP_SECUENCIAL=$numero";              
				  }
              $datos->campoId = "APP_SECUENCIAL";
			$datos->campos =array('APP_SECUENCIAL',
										'APP_CODIGO',
										'APP_DESCRIPCION',
										'APP_NUSUARIOS',
										'BTNUSER',
										'BTNROL', 										
										'APP_VERSION',
										'APP_ESTADO');
			  $datos->tabla="VW_APLICACION";
			  $datos->debug = false;
			  $data=$this->jqtabla->getTabla($datos);
			  foreach($data as $ix)
        {  $ix->BTNUSER='<a href="javascript:void(0);"  class="bt1" data-id='.$ix->APP_SECUENCIAL.'><img src="imagenes/person.jpg" width="20" height="20"  /></a>';
           $ix->BTNROL='<a href="javascript:void(0);"  class="bt2" data-id='.$ix->APP_SECUENCIAL.'><img src="imagenes/edit.jpg" width="20" height="20"  /></a>';
        }
              
		   return $this->jqtabla->finalizarTabla($data, $datos);
   } 
   
   //Datos que seran enviados para la edicion o visualizacion de cada registro seleccionado
   function dataRegistro($numero){
       $sql="select
				APP_SECUENCIAL,
				APP_CODIGO,
				APP_DESCRIPCION,
				APP_VERSION,
				APP_ESTADO
          FROM APLICACION WHERE APP_SECUENCIAL=$numero";
         $sol=$this->db->query($sql)->row();
         if ( count($sol)==0){
                $sql="select
							APP_SECUENCIAL,
							APP_CODIGO,
							APP_DESCRIPCION,
							APP_VERSION,
							APP_ESTADO
                          FROM APLICACION WHERE APP_SECUENCIAL=$numero";
                         $sol=$this->db->query($sql)->row();
						}
          return $sol;
		}
    	
	//funcion para crear un nuevo usuario
    function addSistema(){		
			           
			$APP_CODIGO=strtoupper(($this->input->post('APP_CODIGO')));
			$APP_DESCRIPCION=($this->input->post('APP_DESCRIPCION'));
			$APP_VERSION=strtoupper(($this->input->post('APP_VERSION')));
			
			$SQL="select APP_SECUENCIAL,APP_CODIGO 
				FROM APLICACION 
				where APP_CODIGO='{$APP_CODIGO}'";
			if(empty($this->db->query($SQL)->row()->APP_CODIGO)){
            $sql="INSERT INTO APLICACION (
							APP_CODIGO,
							APP_DESCRIPCION,
							APP_VERSION,
							APP_ESTADO) VALUES(
							'$APP_CODIGO',
							'$APP_DESCRIPCION',
							'$APP_VERSION',
							0)";
            $this->db->query($sql);
            //print_r($sql);
			$APP_SECUENCIAL=$this->db->query("select max(APP_SECUENCIAL) SECUENCIAL from APLICACION")->row()->SECUENCIAL;
				echo json_encode(array("cod"=>$APP_SECUENCIAL,"numero"=>$APP_SECUENCIAL,"mensaje"=>"Sistema: ".$APP_CODIGO.", Registrado con éxito"));
			}else{
				echo json_encode(array("cod"=>1,"numero"=>1,"mensaje"=>alerta("Sistema: ".$APP_CODIGO.", Ya se encuentra registrado")));
			}
    }
    
	//funcion para editar un usuario selccionado
    function editSistema(){
			$APP_SECUENCIAL=$this->input->post('APP_SECUENCIAL'); 			
			$APP_CODIGO=strtoupper(($this->input->post('APP_CODIGO')));
			$APP_DESCRIPCION=($this->input->post('APP_DESCRIPCION'));
			$APP_VERSION=strtoupper(($this->input->post('APP_VERSION')));
			
            $sql="UPDATE APLICACION SET
							APP_CODIGO='$APP_CODIGO',
							APP_DESCRIPCION='$APP_DESCRIPCION',
							APP_VERSION='$APP_VERSION'
                 WHERE APP_SECUENCIAL=$APP_SECUENCIAL";
         $this->db->query($sql);
		 //print_r($sql);
         echo json_encode(array("cod"=>1,"numero"=>$APP_SECUENCIAL,"mensaje"=>"Sistema: ".$APP_CODIGO.", editado en ".$APP_SECUENCIAL." con éxito"));
    }
	
	//Usos para sistema de usuarios	
	//Sistema Usuario
   function getSistemasUser(){
        $user=  $this->input->post('user');
        $datos = new stdClass();
		$datos->campoId = "ACC_SECUENCIAL";
		$datos->campos =array("ACC_SECUENCIAL",
								"ACC_APLICACION",
								"ACC_ESTADO",
								"USR_DESCRIPCION",
								"ACC_FECHAINGRESO",
								"ACC_CREADOPOR");
		$datos->econdicion = "rol.USR_SECUENCIAL=ac.ACC_ROL_USUARIO";
		if (!empty($user)){
            $datos->econdicion .=" and ac.ACC_USUARIO='".($user)."'";
        }
        $datos->tabla = "ACCESO ac
						FULL JOIN ROLES rol
						ON rol.USR_SEC_APLICACION=ac.ACC_SEC_APLICACION";                       
        return $this->jqtabla->finalizarTabla($this->jqtabla->getTabla($datos), $datos);
    }

function getdirectivas($sistema){
     $datos = new stdClass();
     $datos->tabla = "DIRECTIVAS";
     $datos->econdicion = "USD_SEC_APLICACION='$sistema'";
     $datos->campoId = "USD_SECUENCIAL";
     $datos->campos =array("USD_SECUENCIAL",'USD_DESCRIPCION','USD_ALIAS','USD_ESTADO');
     return $this->jqtabla->finalizarTabla($this->jqtabla->getTabla($datos), $datos);
  }
  
  function addappdirectiva(){
        $USD_ALIAS=$this->input->post('USD_ALIAS');
		$USD_DESCRIPCION=$this->input->post('USD_DESCRIPCION');
		$USD_SISTEMA=$this->input->post('USD_SISTEMA');
		$sql="INSERT INTO DIRECTIVAS (
							USD_SEC_APLICACION,
							USD_DESCRIPCION,
							USD_ESTADO,
							USD_ALIAS
							) VALUES(
							'$USD_SISTEMA',
							'$USD_DESCRIPCION',
							0,
							'$USD_ALIAS')";
            $this->db->query($sql);
        echo json_encode(array("cod"=>1,"mensaje"=>  success("Directiva Ingresada con exito")));
    }
	
public function cambiarEstado($sec,$table,$campo,$campSec,$value){
                $this->db->where($campSec, $sec)
                 ->update($table, array( $campo => $value)); 
    }
	
//para roles
public function getRoles($aplicacion){
        $datos = new stdClass;
        $datos->tabla = "ROLES";
        $datos->econdicion = "USR_SEC_APLICACION='$aplicacion'";
        $datos->campoId = "USR_SECUENCIAL";
        $datos->debug=false;
        $datos->campos = array("USR_SECUENCIAL",  "USR_DESCRIPCION","USR_SEC_APLICACION", "USR_ESTADO");
        return $this->jqtabla->finalizarTabla($this->jqtabla->getTabla($datos), $datos);
    }

public function getPerfilesRow($sec){
        return $this->db->where("USR_SECUENCIAL",$sec)
                        ->get("ROLES")
                        ->row_array();
    }

public function addRoles($data){
        unset($data['accion']);
        unset($data['USR_SECUENCIAL']);
        $this->db->insert('ROLES',  array_map("", $data) );
        $output['mensaje'] = success("Perfil almacenado correctamente");
        echo json_encode($output);
    }

public function modRoles($data){
        $this->db->where("USR_SECUENCIAL", $data['USR_SECUENCIAL']);
        unset($data['accion']);
        unset($data['USR_SECUENCIAL']);
        $this->db->update('ROLES',  array_map("", $data) );
        $output['mensaje'] = success("Perfil modificado correctamente");
        echo json_encode($output);
    }
	
public function delRoles($USR_SECUENCIAL){
        $this->db->delete('ROLES', array('USR_SECUENCIAL' => $USR_SECUENCIAL)); 
    }

//funciones para directivas del sistema
function getdirectivasrol($rol){
     $datos = new stdClass();
     $datos->tabla = "PERMISOS,DIRECTIVAS";
     $datos->econdicion = "USD_SECUENCIAL=USP_SEC_DIRECTIVAS AND USP_SEC_ROLES=$rol";
     $datos->campoId = "USP_SECUENCIAL";
     $datos->campos =array("USP_SECUENCIAL",'USD_DESCRIPCION','USD_ALIAS','USP_ESTADO');
     return $this->jqtabla->finalizarTabla($this->jqtabla->getTabla($datos), $datos);
  }	
  
public function comboDirectivasFrm($nombre = "USP_SEC_DIRECTIVAS",$USP_SEC_ROLES = null){
        $sistema=  $this->input->post('sistema');
        $sql="select USD_SECUENCIAL, USD_DESCRIPCION from DIRECTIVAS where USD_SISTEMA='$sistema' AND USD_ESTADO<>1 AND USD_SECUENCIAL  not in ("
                . " select USP_SEC_DIRECTIVAS from PERMISOS where USP_SEC_DIRECTIVAS IS NOT NULL AND USP_SEC_ROLES=$USP_SEC_ROLES) order by USD_DESCRIPCION";
        $result=$this->db->query($sql)->result_array();
        if(!empty($result)){
            $options[null] = "Selecciona una directiva";
            foreach($result as $response){
                $options[$response['USD_SECUENCIAL']] = prepCampoMostrar($response['USD_DESCRIPCION']);
            }
            return form_dropdown($nombre, $options,null, " id='{$nombre}' ");
        }else{
            return alerta("No existen directivas...");
        }
    }

public function getDirectivasRow($USD_SECUENCIAL){
       $funcion = $this->db->select("USD_FUNCTION_EXTRA")
                       ->where("USD_SECUENCIAL = {$USD_SECUENCIAL}")
                       ->get("DIRECTIVAS")
                       ->row()
                       ->USD_FUNCTION_EXTRA;
       if(!empty($funcion)){
           $output = highlight("Por favor, ingresa los elementos para la directiva");
           $output .= $this->lib_usuarios->$funcion(1);
       }else{
           $output = highlight("La directiva no tiene parámetros  adicionales, no es necesario este apartado, para su funcionamiento. 
                                <input type='hidden' name='USP_ELEMENTO' ID='USP_ELEMENTO' value='null' /> ");
       }
       return $output;
    }	

public function addDir($data){
        if(is_array($data['USP_ELEMENTO'])){
            $USP_ELEMENTO = null;
            $elementos = count($data['USP_ELEMENTO']);
            $i = 0;
            foreach ($data['USP_ELEMENTO'] as $USP_TEMP):
                $i++;
            if(!empty($USP_TEMP)){
                if($elementos != $i){
                    $USP_ELEMENTO .= "''".$USP_TEMP . "'',";
                }else{
                    $USP_ELEMENTO .= "''".$USP_TEMP . "'' ";
                }
                }
            endforeach;
            $data['USP_ELEMENTO'] = $USP_ELEMENTO;
        }else{
            $USP_ELEMENTO = null;
        }
        
        $data['USP_ESTADO'] = 0;
        unset($data['USP_ELEMENTO'],$data['USR_SEC_APLICACION']);
        $this->db->set('USP_ELEMENTO',$USP_ELEMENTO,true);
        return $this->db->insert('PERMISOS',$data);
    }	

}
?>