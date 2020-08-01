<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class EstilosExcel
{
      private $default_border = array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb'=>'1006A3')
            );

      function titulo(){
             $CI =&get_instance();
             $CI->load->library('PHPExcel');
             $style_header = array(
                        'borders' => array(
                                'bottom' => $this->default_border,
                                'left' =>  $this->default_border,
                                'top' =>   $this->default_border,
                                'right' => $this->default_border,
                        ),
                        'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb'=>'E1E0F7'),
                        ),
                        'font' => array(
                                'bold' => true,
                        ),
                       'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)

                );
             return $style_header;
        }
		
	function tituloBordes(){
             $CI =&get_instance();
             $CI->load->library('PHPExcel');
             $style_header = array(
                        'borders' => array(
                        'allborders' => array(
                                   'style' => PHPExcel_Style_Border::BORDER_THIN
                        )),
                        'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb'=>'E1E0F7'),
                        ),
                        'font' => array(
                                'bold' => true,
                        ),
                       'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)

                );
             return $style_header;
        }	

        function styleB(){
             $CI =&get_instance();
             $CI->load->library('PHPExcel');
             $styleB= array(
                    'borders' => array(
                    'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                    )));
             return  $styleB;
        }


}
?>