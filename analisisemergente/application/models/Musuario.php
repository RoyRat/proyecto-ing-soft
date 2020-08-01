<?php
class Musuario extends CI_Model {
   
   //Funcion en la cual muestra cada seleccion que ingresemos
   function getdatosItems(){
        $datos = new stdClass();
        $consulta=$_POST['_search'];
        $numero=  $this->input->post('numero');
        $datos->econdicion ='URS.US_ESTADO<>2';
              if (!empty($numero)){
                  $datos->econdicion .="AND URS.US_SECUENCIAL=$numero";              
				  }
              $datos->campoId = "US_SECUENCIAL";              
			   $datos->camposelect = array("URS.US_SECUENCIAL",
											"(SELECT LOC_DESCRIPCION FROM LOCALIZACION WHERE LOC_SECUENCIAL=URS.US_LOCALIZACION) US_LOCALIZACION",
											"URS.US_CEDULA",
											"URS.US_CODIGO",
											"URS.US_NOMBRES",
											"URS.US_APELLIDOS",
											"URS.US_MAIL",
											"URS.US_FECHAINGRESO",
											"URS.US_ESTADO");
			  $datos->campos = array("US_SECUENCIAL",
											"US_LOCALIZACION",
											"US_CEDULA",
											"US_CODIGO",
											"US_NOMBRES",
											"US_APELLIDOS",											
											"US_MAIL",
											"US_FECHAINGRESO",
											"US_ESTADO");
			  $datos->tabla="USUARIO URS";
              $datos->debug = false;
           return $this->jqtabla->finalizarTabla($this->jqtabla->getTabla($datos), $datos);
        //}     
   } 
   
   //Datos que seran enviados para la edicion o visualizacion de cada registro seleccionado
   function dataRegistro($numero){
       $sql="select
				US.US_SECUENCIAL, 
				US.US_LOCALIZACION, 
				US.US_CEDULA, 
				US.US_CODIGO, 
				US.US_CLAVE, 
				US.US_FECHAINGRESO, 
				US.US_NOMBRES, 
				US.US_APELLIDOS, 
				US.US_SIGLAS, 
				US.US_MAIL, 
				US.US_DIRECCION, 
				US.US_CELULAR, 
				US.US_CONVENCIONAL, 
				US.US_ESTADO
          FROM USUARIO US WHERE US.US_SECUENCIAL=$numero";
         $sol=$this->db->query($sql)->row();
         if ( count($sol)==0){
                $sql="select
				US.US_SECUENCIAL, 
				US.US_LOCALIZACION,
				US.US_CEDULA, 
				US.US_CODIGO, 
				US.US_CLAVE, 
				US.US_FECHAINGRESO, 
				US.US_NOMBRES, 
				US.US_APELLIDOS, 
				US.US_SIGLAS, 
				US.US_MAIL, 
				US.US_DIRECCION, 
				US.US_CELULAR, 
				US.US_CONVENCIONAL, 
				US.US_ESTADO
          FROM USUARIO US WHERE US.US_SECUENCIAL=$numero";
                         $sol=$this->db->query($sql)->row();
						}
          return $sol;
		}
    	
	//funcion para crear un nuevo usuario
    function addUsuario(){		
			$sqlfecha="select DATE_FORMAT(SYSDATE(),'%d/%m/%Y %H:%i:%s') FECHA from dual";
			$FECHA=$this->db->query($sqlfecha)->row()->FECHA;
			$US_FECHAINGRESO="STR_TO_DATE('".$FECHA."','%d/%m/%Y %H:%i:%s')";
			$US_CREADOPOR=$this->session->userdata('US_CODIGO');
			
			$US_CODIGO=strtoupper(($this->input->post('US_CODIGO')));
            $US_SIGLAS=strtoupper(($this->input->post('US_SIGLAS')));
			$US_CEDULA=($this->input->post('US_CEDULA'));
			$PAIS=($this->input->post('pais'));
			$PROVINCIA=($this->input->post('provincia'));
			$CIUDAD=($this->input->post('ciudad'));
			$SECTOR=($this->input->post('sector'));
			$US_LOCALIZACION=$SECTOR;
			$US_NOMBRES=($this->input->post('US_NOMBRES'));
			$US_APELLIDOS=($this->input->post('US_APELLIDOS'));
			$US_DIRECCION=($this->input->post('US_DIRECCION'));
			$US_CELULAR=($this->input->post('US_CELULAR'));
			$US_CONVENCIONAL=($this->input->post('US_CONVENCIONAL'));
			$US_MAIL=($this->input->post('US_MAIL'));			
			$US_CLAVE=encriptar('1234');
			
			$SQLCCD="select count(*) CODIGO_CUENTA
				FROM USUARIO 
				where US_CODIGO='{$US_CODIGO}'";				
			$cuentaCodigo=$this->db->query($SQLCCD)->row()->CODIGO_CUENTA;			
			$cuentaMail=$this->db->query("select count(*) MAIL_CUENTA from USUARIO where us_mail='{$US_MAIL}'")->row()->MAIL_CUENTA;
			if(($cuentaMail==0) and ($cuentaCodigo==0)){
            //Ingreso de usario
				$sqlper="INSERT INTO USUARIO (
							US_LOCALIZACION,
							US_CEDULA,
							US_CODIGO,
							US_CLAVE,
							US_COD_VERIFICA,
							US_NOMBRES,
							US_APELLIDOS,
							US_SIGLAS,
							US_MAIL,
							US_DIRECCION,
							US_CELULAR,
							US_CONVENCIONAL,
							US_CREADOPOR,
							US_FECHAINGRESO,
							US_FECHACAMBIO,
							US_ESTADO) VALUES (
							$US_LOCALIZACION,
							'$US_CEDULA',
							UPPER('$US_CODIGO'),
							'$US_CLAVE',
							NULL,
							UPPER('$US_NOMBRES'),
							UPPER('$US_APELLIDOS'),
							UPPER('$US_SIGLAS'),
							LOWER('$US_MAIL'),
							'$US_DIRECCION',
							'$US_CELULAR',
							'$US_CONVENCIONAL',
							'$US_CREADOPOR',
							$US_FECHAINGRESO,
							NULL,
							0)";
            $this->db->query($sqlper);
            //print_r($sql);
			$US_SECUENCIAL=$this->db->query("select max(US_SECUENCIAL) SECUENCIAL from USUARIO")->row()->SECUENCIAL;
				echo json_encode(array("cod"=>$US_SECUENCIAL,"numero"=>$US_SECUENCIAL,"mensaje"=>"Usuario: ".$US_CODIGO.", Registrado con éxito"));
			}else{
				echo json_encode(array("cod"=>1,"numero"=>1,"mensaje"=>alerta("Código o Correo del Usuario: ".$US_CODIGO.", Ya se encuentra registrado")));
			}
    }
    
	//funcion para editar un usuario selccionado
    function editUsuario(){
			$US_SECUENCIAL=$this->input->post('US_SECUENCIAL'); 			
			$US_CODIGO=strtoupper(($this->input->post('US_CODIGO')));
            $US_SIGLAS=strtoupper(($this->input->post('US_SIGLAS')));
			$US_CEDULA=($this->input->post('US_CEDULA'));
			$PAIS=($this->input->post('pais'));
			$PROVINCIA=($this->input->post('provincia'));
			$CIUDAD=($this->input->post('ciudad'));
			$SECTOR=($this->input->post('sector'));
			$US_LOCALIZACION=$SECTOR;
			$US_NOMBRES=($this->input->post('US_NOMBRES'));
			$US_APELLIDOS=($this->input->post('US_APELLIDOS'));
			$US_DIRECCION=($this->input->post('US_DIRECCION'));
			$US_CELULAR=($this->input->post('US_CELULAR'));
			$US_CONVENCIONAL=($this->input->post('US_CONVENCIONAL'));
			$US_MAIL=($this->input->post('US_MAIL'));
			
            $sql="UPDATE USUARIO SET
							US_LOCALIZACION=$US_LOCALIZACION,
							US_CEDULA='$US_CEDULA',
							US_CODIGO=UPPER('$US_CODIGO'),
							US_NOMBRES=UPPER('$US_NOMBRES'),
							US_APELLIDOS=UPPER('$US_APELLIDOS'),
							US_SIGLAS=UPPER('$US_SIGLAS'),
							US_MAIL=LOWER('$US_MAIL'),
							US_DIRECCION='$US_DIRECCION',
							US_CELULAR='$US_CELULAR',
							US_CONVENCIONAL='$US_CONVENCIONAL'
                 WHERE US_SECUENCIAL=$US_SECUENCIAL";
         $this->db->query($sql);
		 //print_r($sql);
         echo json_encode(array("cod"=>1,"numero"=>$US_SECUENCIAL,"mensaje"=>"Usuario: ".$US_CODIGO.", editado con éxito"));
    }
	  
//Mensaje de confirmacion ruta del servidor
function genEnlace($funcion=null){
         $rutaSinCodificar=@$this->config->item('enlaceSistema');
         $rutaACodificar = base64_encode($funcion);  
         return $rutaSinCodificar."usuario/ruta/".$rutaACodificar;
         
      }

public function GrbFrmPrtPass(){
			$this->load->library('SimpleLogin');
                        $this->loginsistema=new SimpleLogin();
			$response = $this->loginsistema->grabarclave($_POST['pass'],$_POST['US_CODIGO']);
			if(empty($response)){
                                $output['cod'] = 0;
				$output['mensaje'] = alerta("No se pudo cambiar la contraseña");
			}else{
                                $output['cod'] = 1;
				$output['mensaje'] = highlight('Contraseña cambiada con éxito');
			}
			echo json_encode($output);
}
	  
//Usos para sistema de usuarios	
	//Sistema Usuario
   function getSistemasUser(){	   
        $user=  $this->input->post('user');
        $datos = new stdClass();        
        $datos->econdicion = "RL.USR_SECUENCIAL=ACC.ACC_SEC_ROLES";
        if (!empty($user)){
            $datos->econdicion .=" AND ACC.ACC_SEC_USUARIO='".($user)."'";
        }
        $datos->campoId = "ACC_SECUENCIAL";
        $datos->campos =array("ACC_SECUENCIAL",
								'ACC_SEC_APLICACION',								
								'APP_CODIGO',
								'USR_DESCRIPCION',
								'ACC_FECHAINGRESO',
								'ACC_CREADOPOR',
								'ACC_ESTADO',);
		$datos->tabla = "ACCESO ACC
						JOIN ROLES RL
						ON ACC.ACC_SEC_APLICACION=RL.USR_SEC_APLICACION
						JOIN APLICACION APP
						ON APP.APP_SECUENCIAL=ACC.ACC_SEC_APLICACION";
        return $this->jqtabla->finalizarTabla($this->jqtabla->getTabla($datos), $datos);
    }

function getUsuariosSistema(){
        $datos = new stdClass;
        $aplicacion=$this->input->post('sistema');
        $datos->tabla = "VW_USUARIO";
        $datos->econdicion="US_APLICACION='$aplicacion' and US_ESTADO<>1";
        $datos->campoId = "ACC_SECUENCIAL";
        $datos->campos = array("ACC_SECUENCIAL",
								"ACC_PERFIL",
								"US_CEDULA", 
								"US_CODIGO", 
								"US_NOMBRES", 								
								"US_MAIL",
								"ACC_ESTADO");
        $data=$this->jqtabla->getTabla($datos);
        $i=1;
        foreach($data as $ix){  
			$ix->US_SECUENCIAL=$i++;
        }
        return $this->jqtabla->finalizarTabla($data, $datos);
    }

function cmbapp($ACC_SEC_APLICACION= 0, $ACC_SEC_USUARIO = null, $attr = null,$name) {
		   $query = $this->db->query("SELECT APP_SECUENCIAL,APP_CODIGO 
										FROM APLICACION  
										WHERE APP_ESTADO<>1 
												AND APP_CODIGO NOT IN ( SELECT ACC_SEC_APLICACION 
																			FROM ACCESO 
																		WHERE ACC_SEC_USUARIO=$ACC_SEC_USUARIO 
																		and ACC_SEC_APLICACION<>$ACC_SEC_APLICACION) 
																		ORDER BY APP_CODIGO");
            $results = $query->result_array();
            $output = array();
            if ($query->num_rows() > 0) {
                $output[null] = "Seleccionar...";
                foreach ($results as $result) {
                    $output[$result['APP_SECUENCIAL']] = utf8_encode($result['APP_CODIGO']);
                }
                return form_dropdown($name, $output, $ACC_SEC_APLICACION, $attr);
            } else {
                return alerta("No existen datos. <input type='hidden' name=$name value='' />");
            }
    }

function cmbperfil($USR_SEC_APLICACION= null, $CODIGO = null, $attr = null,$name='APP_GESTOR') {
        if ($USR_SEC_APLICACION== null) {
            $output[null] = "Seleccionar...";
            return form_dropdown($name, $output, $CODIGO, $attr);
        } else {
                $query = $this->db->query("SELECT USR_SECUENCIAL, USR_DESCRIPCION 
											FROM ROLES 
											WHERE USR_SEC_APLICACION='".$USR_SEC_APLICACION."'  
											and  USR_ESTADO<>1  
											order by USR_DESCRIPCION ");
            $results = $query->result_array();
            $output = array();
            if ($query->num_rows() > 0) {
                $output[null] = "Seleccionar....";
                foreach ($results as $result) {
                    $output[$result['USR_SECUENCIAL']] = ($result['USR_DESCRIPCION']);
                }
                return form_dropdown($name, $output, $CODIGO, $attr);
            } else {
               $output[null] = "Seleccionar...";
               return form_dropdown($name, $output, $CODIGO, $attr);
            }
        }
    }

function addappuser(){
        $sql="SELECT ACC_SEC_USUARIO 
				FROM ACCESO 
			   WHERE ACC_SEC_APLICACION='".$_POST['ACC_SEC_APLICACION']."' 
			   and ACC_SEC_USUARIO='".$_POST['ACC_SEC_USUARIO']."'";
        $user=$this->db->query($sql)->row();
        if (count($user)>0){
            echo json_encode(array("cod"=>0,"mensaje"=>  alerta("El usuario ya tiene esta aplicacion")));
        } else {
                if (empty($_POST['ACC_SEC_ROLES'])){
                     $this->generales->retirarCamposExtras(array('accion','US_NOMBRES','ACC_SECUENCIAL','ACC_SEC_ROLES'));
                } else {
                     $this->generales->retirarCamposExtras(array('accion','US_NOMBRES','ACC_SECUENCIAL'));
                }
                     $this->db->set("ACC_CREADOPOR",$this->session->userdata('US_CODIGO'));
                     $set['ACC_FECHAINGRESO'] = "SYSDATE()";
                     $this->generales->add('ACCESO',$set);
                     echo json_encode(array("cod"=>1,"mensaje"=>  success("Ingresado con exito")));
			}
     }

function editappuser(){
            if (empty($_POST['ACC_SEC_ROLES'])){
                $this->generales->retirarCamposExtras(array('accion','US_NOMBRES','ACC_SEC_ROLES'));
            } else {
                 $this->generales->retirarCamposExtras(array('accion','US_NOMBRES'));
            }
            $set=  $_POST;
            $this->db->where("ACC_SECUENCIAL",$_POST['ACC_SECUENCIAL']);
            $this->db->update('ACCESO',array_map("", $set));
            echo json_encode(array("cod"=>1,"mensaje"=>success("Actualizado con exito")));
     }	 

}
?>