<?php
class Lugar extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->lib_usuarios->check(); // Validador de sessiones
        $this->load->model('mlugar');
        $this->load->model('mvarios');
		$this->load->library('table');
    }
	   
    public function index(){
        $this->load->view("lugar/js/lugar_index_js");
        $this->load->view("lugar/js/lugar_lugar_items_js");
        $this->load->view("lugar/lugar_index_v");
    }
        
    public function mostfrmLugarItems(){
        if(!empty($_POST['LOC_SECUENCIAL']) and ($_POST['ADM'] == 2)){
			$data['LOC_SECUENCIAL'] = $this->mlugar->getLugarItemsRow()->LOC_SECUENCIAL;			
			$data['LOC_DESCRIPCION'] = $this->mlugar->getLugarItemsRow()->LOC_DESCRIPCION;			
			$data['LOC_PREDECESOR'] = $this->mlugar->getLugarItemsRow()->LOC_PREDECESOR;			
			$data['LOC_NIVEL'] = $this->mlugar->getLugarItemsRow()->LOC_NIVEL;			
			$data['LOC_CODIGO_AREA'] = $this->mlugar->getLugarItemsRow()->LOC_CODIGO_AREA;			
			$data['LOC_ESTADO'] = $this->mlugar->getLugarItemsRow()->LOC_ESTADO;			
        }else{
            $data = null;
        }
		
	if($_POST['ADM'] != 3){	
		$this->load->view("lugar/js/frmLugarItems_js",$data);
		$this->load->view("lugar/frmLugarItems_v",$data);
	}else{
            $data['field'] = "LOC_SECUENCIAL";
            $data['item'] = $this->generales->getCampo($campo = "LOC_DESCRIPCION",$tabla = "LOCALIZACION",$campoWhere = "LOC_SECUENCIAL",$dataWhere = $_POST['LOC_SECUENCIAL'])->LOC_DESCRIPCION;
            $data['mensaje'] = '¿Esta seguro qué desea eliminar el item: <b>'.$data['item'].'</b>?.';
            $data['tipAlert'] = "alerta";		
			$this->load->view("general/dialog_confirmacion",$data);
	}
    }
    
	public function grbLugarItem(){
        $html_output = $this->mlugar->grbLugarItem();
        echo json_encode($html_output);
    }
    
    public function getLugarItems(){
        echo $this->mlugar->getLugarItems();
    }
    
}
?>