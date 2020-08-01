<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Configuración para la librería de envío de correo
$config['protocol']  = "mail";
$config['smtp_host'] = "srvuiomx4.azul.com.ec";
$config['smtp_port'] = "225";
$config['mailtype'] = 'html';
$config['charset']  = 'utf-8';
$config['wordwrap'] = TRUE;
$config['wrapchars'] = 76;