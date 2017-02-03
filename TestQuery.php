<?php
include_once("gpits_core.php");
include_once("XmlDriver.php");
include_once("MoodleToolsDomainKnowledge.php");

$q = new Query();
$q->get_property = 'ventajas';
$q->addField('nombre', 'Base de Datos');
$x = new XmlDriver();
$data = $x->runQuery($q);
if($data != null)
  echo $data . " <br />";
else
  echo "Por el momento no cuento con esa informacion <br />";

echo "Done... <br />";

$dk = new MoodleToolsDomainKnowledge();
echo var_dump($dk->data);

$q2 = $dk->generateQuery('Que es el Chat');
$data = $x->runQuery($q2);
if($data != null)
  echo $data . " <br />";
else
  echo "Por el momento no cuento con esa informacion <br />";

$q2 = $dk->generateQuery('Como se usa la Base de Datos');
$data = $x->runQuery($q2);
if($data != null)
  echo $data . " <br />";
else
  echo "Por el momento no cuento con esa informacion <br />";
