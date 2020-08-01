<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generales{
	 /* BDD generico */
    
	public $pdata;
	protected $prData;
	private $data;
	
    public function add($table= null,$set = null){
		$CI =& get_instance();
        if(!empty($set)){
            foreach($set as $field => $content){
                $content = prepCampoAlmacenar($content);
                $CI->db->set($field, $content,false);
            }
        }
        
        $_POST = array_map("prepCampoAlmacenar", $_POST);
		return $CI->db->insert($table,$_POST)?true:false;
    }
    
    public function mod($table = null,$whereField = null,$whereValue = null,$set = null){
        $CI =& get_instance(); 
		if(!empty($set)){
            foreach($set as $field => $content){
                $content = prepCampoAlmacenar($content);
                $CI->db->set($field, $content,false);
            }
        }
        $_POST = array_map("prepCampoAlmacenar", $_POST);
        $CI->db->where($whereField,$whereValue);
        return $CI->db->update($table, $_POST)?true:false;
    }
    
    public function del($table = null,$whereField = null,$whereValue = null,$setField = null,$setValue = null){
		$CI =& get_instance();
        return $CI->db->set($setField,$setValue)->where($whereField,$whereValue)->update($table)?true:false;
    }
	
	public function retirarCamposExtras($array = null){
        if (!empty($array)){
            foreach ($array as $string){
                unset($_POST[$string]);
            }
        }
        return $this;
    }
	
	public function getCampo($campo = null,$tabla = null,$campoWhere = null,$dataWhere = null){
        $CI =& get_instance();
        if(!empty($dataWhere)and!empty($campoWhere)): $CI->db->where($campoWhere,$dataWhere); endif;
        if(!empty($campo)): $CI->db->select($campo, false); endif;
        if(!empty($tabla)): $query = $CI->db->get($tabla); endif;
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return null;
        }
    }
	
	public function genEstrucFecha($campo = null){
		return "TO_CHAR(".$campo.", 'yyyy-mm-dd hh24:mi:ss') ".$campo;
	}
	
	protected function modArrayCmb($index = null, $value = null){
		foreach($this->pdata as $val){
			$val = array_map("prepCampoMostrar", $val);
			$tmp[$val[$index]] = $val[$value];
		}
		$this->pdata = $tmp;
		return $this;
	}
	
	protected function arrayVwUsuario(){
		$CI =& get_instance();
		$this->pdata = $CI->db->select('US_CODIGO,US_NOMBRE')
							 ->order_by("US_NOMBRE", "ASC")
							 ->get('VW_USUARIO')
							 ->result_array();
		return $this;
	}
	
	protected function getListArrayCmb($LST_ALIAS = null){
		$CI =& get_instance();
		$this->pdata = $CI->db->select("LSI_SEC,LSI_NOMBRE")
							  ->where("LST_ALIAS",$LST_ALIAS)
							  ->order_by("LSI_NOMBRE","ASC")
							  ->get("VW_BUSLISTAS")
							  ->result_array();
		return $this;
	}
        

    
    public function retirarCamposExtrasdatos($array = null,$datos){
        if (!empty($array)){
            foreach ($array as $string){
                unset($datos[$string]);
            }
        }
        return $datos;
    }
}
?>
	