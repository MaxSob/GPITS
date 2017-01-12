<?php
include_once("Domain.php");
include_once("XmlDriver.php");

function getResponse($msg) {
    $que_es = ['QUE ES'];
    $utilidad = ['PARA QUE SIRVE', 'QUE HACE', 'COMO SE USA'];
    $herramientas = ['Foro', 'Tarea', 'Etiqueta', 'Externa'];
    $hola = ['HOLA'];

    if(containsKeyword($msg, $hola)) {
        return json_encode(['respuesta'=> 'Soy una herramienta automatizada para dar informacion acerca de las herramientas de moodle']);
    }

    if(containsKeyword($msg, $que_es)) {
        if(containsKeyword($msg, ['FORO']))
            return json_encode(['respuesta'=> 'El Foro es una herramienta...']);
        if(containsKeyword($msg, ['TAREA']))
            return json_encode(['respuesta'=> 'La Tarea es una herramienta...']);
        if(containsKeyword($msg, ['ETIQUETA']))
            return json_encode(['respuesta'=> 'La Etiqueta es una herramienta...']);
    }

    if(containsKeyword($msg, $utilidad)) {
            if(containsKeyword($msg, ['FORO']))
                return json_encode(['respuesta'=> 'El Foro se usa para...']);
            if(containsKeyword($msg, ['TAREA']))
                return json_encode(['respuesta'=> 'La Tarea se usa para...']);
            if(containsKeyword($msg, ['ETIQUETA']))
                return json_encode(['respuesta'=> 'La Etiqueta se usa para...']);
    }

    return json_encode(['respuesta'=> 'Puedes reformular la pregunta?']);
}


function containsKeyword($string, $array) {
    foreach($array as $v) {
        if(strpos(strtoupper(" " . $string), strtoupper($v)) != false) {
            //echo "Found $v <br />";
			return true;
        }
	}
	return false;
}

$msg = $_REQUEST["msg"];
echo getResponse($msg);
//return getResponse($msg);
