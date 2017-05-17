<?php
include_once("gpits_core.php");
include_once("XmlDriver.php");
include_once("MoodleToolsDomainKnowledge.php");
include_once("mits.php");

function getResponse($msg) {
  $domain = new MoodleToolsDomainKnowledge();
  $driver = new XmlDriver();
  $query = $domain->generateQuery($msg);
  //$query = $domain->generateQuery('Que es un chat');
  if(count($query->fields) == 0)
    $query->addField('nombre', 'CONVERSATION');
  //echo $query . "<br />";
  $data = $driver->runQuery($query);
  if($data == null || $data == '')
    $data = "Puedes reformular la pregunta?";
   /*echo $data;
   echo var_dump($data);*/

  return json_encode(['respuesta'=> $data]);
}

$msg = $_REQUEST["msg"];
$user = ($_REQUEST["user"])?$_REQUEST["user"]:'1';
//echo getResponse($msg);

$controller = new MITSController();
echo $controller->processQuery($msg, $user);
//return getResponse($msg);

//This output should be commented
$profiler = new MITSUserProfiler();
var_dump($profiler->decideUserProfile($user));
