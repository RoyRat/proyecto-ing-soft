<?php
class Mlugar extends CI_Model {

    private $temporal;
    public $out,$return;
    
    public function getLugarItems(){
         $_REQUEST["nodeid"] = !empty($_REQUEST["nodeid"])?$_REQUEST["nodeid"]:0;
        $_REQUEST["n_level"] = !empty($_REQUEST["n_level"])?$_REQUEST["n_level"]:0;
        $node = (integer)$_REQUEST["nodeid"];
        $n_lvl = (integer)$_REQUEST["n_level"];

        $sql1="SELECT * FROM LOCALIZACION where LOC_NIVEL in (1,2,3,4) AND LOC_ESTADO=0";
        $count = $this->db->query($sql1)->num_rows();

        // Buscar Hojas del arbol no tienen hijos
        $SQL2="SELECT T1.LOC_SECUENCIAL SEC  
				FROM LOCALIZACION  
				T1 WHERE T1.LOC_ESTADO =0 
				AND T1.LOC_SECUENCIAL NOT IN (SELECT DISTINCT T2.LOC_PREDECESOR 
                                                    FROM LOCALIZACION T2  
                                                    WHERE T2.LOC_ESTADO =0 
                                                    AND T2.LOC_PREDECESOR <> 0  
                                                    AND T2.LOC_NIVEL IN (1,2,3,4)) 
				ORDER BY LOC_SECUENCIAL";
        $result = $this->db->query($SQL2)->result_array();
        
        $leafnodes = array();
        
        foreach($result as $sinhijos):
                $leafnodes[$sinhijos['SEC']] = $sinhijos['SEC'];
        endforeach;
		
		$respuesta = new stdClass;
        $respuesta->page = 1;
        $respuesta->total = 1;
        $respuesta->records = $count;
    
    	if($node >0) { // check to see which node to load
    		$wh = "LOC_PREDECESOR=".$node; // parents
    		$n_lvl = $n_lvl+1; // we should ouput next level
    	} else {
    		$wh = "LOC_PREDECESOR = 0"; // roots
    	}
		
    	
    	$SQL = "SELECT * FROM LOCALIZACION WHERE  ".$wh." AND LOC_ESTADO=0 and LOC_NIVEL IN (1,2,3,4) ORDER BY LOC_DESCRIPCION";
    	//print_r($SQL);
		$result = $this->db->query($SQL)->result();
    	$i=0;
    	
    	foreach($result as $f){
    		if(!$f->LOC_PREDECESOR) $valp = 'null'; else $valp = $f->LOC_PREDECESOR;
    		if(!empty($leafnodes[$f->LOC_SECUENCIAL])) $leaf='true'; else $leaf = 'false';
    	
    		$respuesta->rows[$i]['id']=$f->LOC_SECUENCIAL;
    		$respuesta->rows[$i]['cell']=array(
    				$f->LOC_SECUENCIAL,
    				($f->LOC_DESCRIPCION),
                    $f->LOC_PREDECESOR,
    				$n_lvl,
    				$valp,
    				$leaf,
    				'false'
    		);
    		$i++;			
    	}
		
    	return json_encode($respuesta);
    }  
    
     //Administrativas Listas Items
    
    public function grbLugarItem(){
       if(!empty($_POST['ADM'])){
           $_POST = array_map("prepCampoAlmacenar", $_POST);
           switch($_POST['ADM']){
               case 1:
					//Ingreso Nueva LOCALIZACION
					$LOC_DESCRIPCION=strtoupper(($this->input->post('LOC_DESCRIPCION')));				
					$LOC_CODIGO_AREA=($this->input->post('LOC_CODIGO_AREA'));
					$LOC_PREDECESOR=$this->input->post('LOC_PREDECESOR');					
					if($LOC_PREDECESOR==0){
						$LOC_NIVEL=1;
					}else{
						$PREDECESOR=$this->db->query("select LOC_PREDECESOR from LOCALIZACION where LOC_SECUENCIAL=$LOC_PREDECESOR")->row()->LOC_PREDECESOR;
						if($PREDECESOR==0){
							$LOC_NIVEL=2;	
						}else{
							$PREDECESOR2=$this->db->query("select LOC_PREDECESOR from LOCALIZACION where LOC_SECUENCIAL=$PREDECESOR")->row()->LOC_PREDECESOR;
							if($PREDECESOR2==0){
								$LOC_NIVEL=3;
							}else{
								$PREDECESOR3=$this->db->query("select LOC_PREDECESOR from LOCALIZACION where LOC_SECUENCIAL=$PREDECESOR2")->row()->LOC_PREDECESOR;
								if($PREDECESOR3==0){
									$LOC_NIVEL=4;
								}else{
									$LOC_NIVEL=5;
								}	
							}
						}
					}			
					if($LOC_NIVEL!=5){
					$sql="INSERT INTO LOCALIZACION (
							LOC_DESCRIPCION,
							LOC_PREDECESOR,
							LOC_NIVEL,
							LOC_CODIGO_AREA,
							LOC_ESTADO) VALUES 
							('$LOC_DESCRIPCION',                    
							$LOC_PREDECESOR,
							$LOC_NIVEL,
							'$LOC_CODIGO_AREA',0)";
					$this->db->query($sql);					
					//print_r($sql);
						$html_output['mensaje'] = success("Lugar: <b>".$LOC_DESCRIPCION."</b>, Ingresado Con exito");
					}else{
						$html_output['mensaje'] = alerta("No se Puede Almacenar, Solo se admiten 4 niveles");	
					}
					
               break;
               case 2:
			   //MODIFICAR LOCALIZACION			   
					$LOC_SECUENCIAL=$this->input->post('LOC_SECUENCIAL');
					$LOC_DESCRIPCION=strtoupper(($this->input->post('LOC_DESCRIPCION')));
					$LOC_CODIGO_AREA=($this->input->post('LOC_CODIGO_AREA'));
					$sql="UPDATE LOCALIZACION SET
							LOC_DESCRIPCION='$LOC_DESCRIPCION',
							LOC_CODIGO_AREA='$LOC_CODIGO_AREA'
						WHERE LOC_SECUENCIAL=$LOC_SECUENCIAL";
						$this->db->query($sql);
					$html_output['mensaje'] = success("Lugar: <b>".$LOC_SECUENCIAL."</b>, Modificado Con exito");
               break;
	       case 3:
				//Eliminar LOCALIZACION
                $LOC_SECUENCIAL=$this->input->post('LOC_SECUENCIAL');
					$sql="UPDATE LOCALIZACION SET
							LOC_ESTADO=1
						WHERE LOC_SECUENCIAL=$LOC_SECUENCIAL";
						$this->db->query($sql);
					$html_output['mensaje'] = alerta("Lugar: <b>".$LOC_SECUENCIAL."</b>, Anulado Con exito");
           }
        }else{
            $html_output['mensaje'] = alerta("No se puede almacenar; no tiene definida la acción.");
        }
        return $html_output;
    }
    
	//GetRowData
    public function getLugarItemsRow(){ 
		return $this->db->where("LOC_SECUENCIAL",$_POST['LOC_SECUENCIAL'])
                        ->get("LOCALIZACION")
                        ->row();
    }	
}
?>