<?php
if (file_exists('knowledgebase.xml')) {
    $xml = simplexml_load_file('knowledgebase.xml');
    echo $xml->nombre;
    echo $xml->que_es;
    echo $xml->descripcion;
    echo $xml->como_funciona;
    echo $xml->ejemplo;
 
    //print_r($xml);
} else {
    exit('Error abriendo knowledgebase.xml.');
}
?>
