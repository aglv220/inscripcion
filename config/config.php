<?php 

unset($CNG);
global $CNG;
$CNG = new stdClass();

// $CNG->dirroot     = $_SERVER['DOCUMENT_ROOT'].'/inscripcion';
// $CNG->wwwroot     = 'http://pees.minsa.gob.pe/inscripcion';
$CNG->dirroot     = $_SERVER['DOCUMENT_ROOT'].'/ensap';
$CNG->wwwroot     = 'http://localhost/ensap/';
$CNG->admin       = 'admin';
$CNG->maintenance =  false;

$CNG->directorypermissions = 0775;

//setlocale(LC_TIME, 'es_ES', 'esp_esp');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!