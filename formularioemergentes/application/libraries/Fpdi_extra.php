<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 # override the default TCPDF config file

require(APPPATH.'config/tcpdf'.EXT);
require('application/3rdparty/fpdf/'.'fpdf.php');
require('application/3rdparty/fpdf/'.'fpdi.php');
/*require_once($tcpdf['tcpdf_directory'].'fpdf.php');
require_once($tcpdf['tcpdf_directory'].'fpdi.php');*/

class Fpdi_extra extends FPDI
{
    public $files = array();

    public function setFiles($files)
    {
        $this->files = $files;
    }

    public function concat()
    {
        foreach($this->files AS $file) {
            $pageCount = $this->setSourceFile($file);
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                 $tplIdx = $this->ImportPage($pageNo);
                 $s = $this->getTemplatesize($tplIdx);
				 $this->setPrintFooter(false);
				 $this->setPrintHeader(false);
                 $this->AddPage($s['w'] > $s['h'] ? 'L' : 'P', array($s['w'], $s['h']));
                 $this->useTemplate($tplIdx);
            }
        }
    }
}
		
 ?>