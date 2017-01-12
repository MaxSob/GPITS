<?php
include_once("Domain.php");
include_once("XmlDriver.php");

$q = new Query();
$q->getProperty = 'descripcion';
$q->addField('nombre', 'foro');
$x = new XmlDriver();
$data = $x->runQuery($q);
if($data != null) {
  echo $data . "<br />";
}
echo "Done <br />";
