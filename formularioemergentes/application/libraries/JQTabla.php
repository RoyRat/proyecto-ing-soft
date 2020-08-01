<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class JQTabla{

  function get_sql_options($datos)
  {
    $CI =& get_instance();
  	//página requerida
    $page = $CI->input->post('page');
    //rows número de filas requeridas
    $limit = $CI->input->post('rows');
    //sidx obtener el indice de la columna
    $sidx = $CI->input->post('sidx');
    //si no se pasa el indice de la columna se
    //selecciona la primera column
    if(!$sidx) $sidx = 1;
    //sord ordenamiento desc asc
    $sord = $CI->input->post('sord');
    $sql = "select count(*) numFilas ".$datos->sqlNumFilas;
    $q = $CI->db->query($sql);
    $count = $q->row()->numFilas;
    if($count > 0)
    {
    	$total_pages = ceil($count/$limit);
    }
    else
    {
    	$total_pages = 0;
    }
    
    // if for some reasons the requested page is greater than the total
    // set the requested page to total page
    if ($page > $total_pages) $page=$total_pages;
    // calculate the starting position of the rows
    $start = $limit*$page - $limit;
    // if for some reasons start position is negative set it to 0
    // typical case is that the user type 0 for the requested page
    if($start <0) $start = 0;

    $sqlSearch = " ";

    if($CI->input->post('_search') == 'true')
    {
    	$f = $CI->input->post('searchField');
    	$s = $CI->input->post('searchString');
      $op = $CI->input->post('searchOper');
      $parametros = array('cn' => " like '%#%'", 'bw' => " like '%#%'",
      'eq' => " ='#'",'ne' => " != '#'", 'lt' => " <'#'",'gt' => " >'#'",
      'ew' => " like '%#%'");
      $cr = $parametros[$op];
      $cs = str_replace("#", addslashes($s), $cr);
      $sqlSearch = " and " . $f . $cs ;
    }

    $d->page = $page;
  	$d->sord = $CI->input->post('sord');
  	$d->sidx = $CI->input->post('sidx');
  	$d->total_pages = $total_pages;
  	$d->records = $count;
  	$d->start = $start;
  	$d->limit = $limit;
  	$d->sqlSearch = $sqlSearch;
  	return $d;
  }

  function get_json($datos)
  {
  	$r->page = $datos->page;
    $r->total = $datos->total_pages;
    $r->records = $datos->records;
    $campoId = $datos->campoId;
    foreach($datos->afilas as $ix => $f)
    {
    	$r->rows[$ix]['id'] = $f->$campoId;
    	$afila = array();
      foreach($datos->campos as $c)
      {
      	$afila[] = $f->$c;
      }
      $r->rows[$ix]['cell'] = $afila;
    }
    return json_encode($r);
  }

  function getTabla($datos)
  {
    $CI =& get_instance();
    //página requerida
    $page = $CI->input->post('page');
    //rows número de filas requeridas
    $limit = $CI->input->post('rows');
    //sidx obtener el indice de la columna
    $sidx = $CI->input->post('sidx');
    //si no se pasa el indice de la columna se selecciona la primera column
    if(!$sidx) $sidx = 1;
    //sord ordenamiento desc asc
    $sord = $CI->input->post('sord');
    
    /*
     * Cambio el lugar de la búsqueda para que sea adecuado el conteo de items
     */
    
    $sqlSearch = " ";

    if($CI->input->post('_search') == 'true')
    {    $searchstr = $CI->input->post('filters');
         $searchField = $CI->input->post('searchField') . " | " . strtoupper($CI->input->post('searchString')) . " | " . $CI->input->post('searchOper');
         $condicion= $this->formarCondicion($searchstr, $searchField);
   $condicion= $this->formarCondicion($searchstr);
         if(empty($datos->wcondicion)){
             $condicionConteo = " WHERE ". $condicion;
         }else{
             $condicionConteo = " AND " . $condicion;
         }
         
         $condicion = $condicion ." and ";
         $econdicion = !empty($datos->econdicion)?" AND ".$datos->econdicion:null;
    }else{
        $condicion = null;
        $condicionConteo = null;
        $econdicion = null;
        $econdicion = !empty($datos->econdicion)?" WHERE ".$datos->econdicion:null;
    }
    
    
    
    
    $sql = "select count(*) numFilas from ".$datos->tabla .  $condicionConteo . $econdicion;
    
    if(!empty($datos->debug)){
        echo "<p><b>Contador de filas</b>".$sql."</p>";
    }
    $query = $CI->db->query($sql);
    $result = $query->row();
    $count = $result->NUMFILAS;
        
    
    if (empty($limit)){
        $limit = $datos->limit;
    }
    
    if($count > 0){
    	$total_pages = ceil($count/$limit);
    }else{
    	$total_pages = 1;
    }
    
    if (empty($page)){
        $page = 1;
    }
    
    $final = $page * $limit;
    $start = $final - $limit;
    
    if($page > 1){
        $start = ($final - $limit) + 1;
    }
    
    $final .=!empty($datos->wcondicion) ? " ". $datos->wcondicion : null;
  if(empty($datos->camposelect)){
      $campos=$datos->campos;
  }   else {
      $campos=$datos->camposelect;
  }

    $sql = "SELECT  ".implode(",",$datos->campos )." FROM
(SELECT  ".implode(",",$campos).", ROW_NUMBER() OVER (ORDER BY $sidx $sord) R FROM ".$datos->tabla.$condicionConteo.$econdicion.")
WHERE ".$condicion." R BETWEEN ".$start." and ".$final." ORDER BY $sidx $sord";
    $q = $CI->db->query($sql);
    
    if(!empty($datos->debug)){
    	echo "<p><b>Consulta en general</b>".$sql."</p>";  
    }
    
    return  $afilas = $q->result();
  }
  
  function finalizarTabla($data = null,$datos = null){
    $CI =& get_instance();
    $page = $CI->input->post('page');
    $limit = $CI->input->post('rows');
    $sidx = $CI->input->post('sidx');
    if(!$sidx) $sidx = 1;
    $sord = $CI->input->post('sord');
    $sqlSearch = " ";

    if($CI->input->post('_search') == 'true')
    {    $searchstr = $CI->input->post('filters');
         $searchField = $CI->input->post('searchField') . " | " . $CI->input->post('searchString') . " | " . $CI->input->post('searchOper');
    	 $condicion= $this->formarCondicion($searchstr, $searchField);
         if(empty($datos->wcondicion)){
             $condicionConteo = " WHERE ". $condicion;
         }else{
             $condicionConteo = " AND " . $condicion;
         }
         $condicion = $condicion ." and ";
         $econdicion = !empty($datos->econdicion)?" AND ".$datos->econdicion:null;
    }else{
        $condicion = null;
        $condicionConteo = null;
        $econdicion = !empty($datos->econdicion)?" WHERE ".$datos->econdicion:null;
    }
    
    
    
    
    $sql = " select count(*) numFilas from ".$datos->tabla . $condicionConteo . $econdicion;
    $query = $CI->db->query($sql);
    $result = $query->row();
    $count = $result->NUMFILAS;
    if (empty($limit)){
        $limit = $datos->limit;
    }
    if($count > 0){
    	$total_pages = ceil($count/$limit);
    }else{
    	$total_pages = 1;
    }
    if (empty($page)){
        $page = 1; 
    }
    $r = new stdClass();
        $r->page = $page;
        $r->total = $total_pages;
        $r->records = $count;
        $campoId = $datos->campoId;
        foreach($data as $ix => $f)
        { 
            $r->rows[$ix]['id'] = $f->$campoId;
            $data = array();
          foreach($datos->campos as $c) 
          {
            $data[] = prepCampoMostrar($f->$c);
          }
          $r->rows[$ix]['cell'] = $data;
        }
       return json_encode($r);
  }

  function formarCondicion($s = null, $searchField = null){
      $qwery = null; 
      $qopers = array(
				  'eq'=>" = ",
				  'ne'=>" <> ",
				  'lt'=>" < ",
				  'le'=>" <= ",
				  'gt'=>" > ",
				  'ge'=>" >= ",
				  'bw'=>" LIKE ",
				  'bn'=>" NOT LIKE ",
				  'in'=>" IN ",
				  'ni'=>" NOT IN ",
				  'ew'=>" LIKE ",
				  'en'=>" NOT LIKE ",
				  'cn'=>" LIKE " ,
				  'nc'=>" NOT LIKE " );
      if(!empty($s)){
          
        if ($s) {
            $jsona = json_decode($s,true);
            if(is_array($jsona)){
		$gopr = $jsona['groupOp'];
		$rules =$jsona['rules'];
                $i =0;
                foreach($rules as $key=>$val) {
                    $field = "UPPER(".$val['field'].")";
                    $op = $val['op'];
                    $v = utf8_decode($val['data']);
                    if($op) {
                            $i++;
                            $v = $this->ToSql($field,$op,$v);
                            if ($i>1) $qwery .= " " .$gopr." ";
                            switch ($op) {
                                    // in need other thing
                                case 'in' :
                                case 'ni' :
                                    $qwery .= $field.$qopers[$op]." (".$v.")";
                                    break;
                                    default:
                                    $qwery .= $field.$qopers[$op]."UPPER(".$v.")";
                            }
                    }
             } //foreach
        }
    }
    }else{
        $arg = explode(" | ", $searchField);
        if(!empty($arg[1])){
            $searchString = is_numeric(trim($arg[1]));
            if($searchString){
                $qwery .= $arg[0].$qopers[$arg[2]]." ".$arg[1]." ";
            }else{
                $qwery .= $arg[0].$qopers[$arg[2]]."'%".addslashes($arg[1])."%'";
            }
            
        }else{
            if ( "nu" == $arg[2]){
                $qwery .= $arg[0]." IS NULL";
            }else{
               $qwery .= $arg[0]." IS NOT NULL";
            }
            
        }
        
    }
    return $qwery;
}

 function ToSql ($field, $oper, $val) {
	// we need here more advanced checking using the type of the field - i.e. integer, string, float
	if (!(is_numeric($val)))
			    $val=strtoupper($val) ;
	switch ($field) {
		case 'id':
			return intval($val);
			break;
		default :
			//mysql_real_escape_string is better
			if($oper=='bw' || $oper=='bn') return "'%" . addslashes($val) . "%'";
			else if ($oper=='ew' || $oper=='en') return "'%" . addcslashes($val) . "'";
			else if ($oper=='cn' || $oper=='nc') return "'%" . addslashes($val) . "%'";
			else return "'" . addslashes($val) . "'";
     }
 }

   function getArray($datos)
  {
    $CI =& get_instance();
    $condicion = null;
    $orden=null;
    $condicion = !empty($datos->condicion)?" WHERE ".$datos->condicion:null;
    $orden = !empty($datos->orden)?" ORDER BY ".$datos->orden:null;
    $sql = "SELECT  ".implode(",",$datos->camposelect)." FROM ".$datos->tabla.$condicion.$orden;
    $data= $CI->db->query($sql)->result();
    $campoId = $datos->campoId;
    foreach($data as $ix => $f){
      $r[$ix]->id= $f->$campoId;
       foreach($datos->campos as $c) {
           $r[$ix]->$c=prepCampoMostrar($f->$c);
      }        
    }
    $arr1=json_encode($r);
    $newarr=substr($arr1,0, strlen($arr1) );
    return $newarr;
  }

  function get_items($datos) {
    $CI =& get_instance();
    $orden=null;
    $condicion =null;
    if (!(empty($datos->filtros))){
        $condicion= $this->formarCondicion($datos->filtros);
    }
     if (!empty($datos->econdicion)){
         if(!empty($condicion)){
             $condicion.=" and ";
         }
         $condicion.=$datos->econdicion;
     }
      if(strlen($datos->econdicion)>0){
             $condicion= " where ".$condicion;
         }
    $orden = !empty($datos->orden)?" ORDER BY ".$datos->orden:null;
    $sql = "SELECT  ".implode(",",$datos->camposelect)." FROM ".$datos->tabla.$condicion.$orden;
    if($datos->debug==true){
        echo($sql);
    }
    return $CI->db->query($sql)->result_array();

  }

}
?>