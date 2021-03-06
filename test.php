<?php
include_once("gpits_core.php");
include_once("XmlDriver.php");
include_once("MoodleToolsDomainKnowledge.php");
include_once("mits.php");
include_once("StringUtils.php");

function getResponse($msg, $user) {
  $tutor = new MITSTutor();
  return $tutor->attendRequest($msg, $user);
}

function getRecommendation($user) {
  $tutor = new MITSTutor();
  return $tutor->decideFedBack($user); 
}

$msg = "Que es le foro";
$user = '1';
$r = ($_REQUEST["r"])?$_REQUEST["r"]:'0';

if($r != '0') {
  //echo "Recommending <br />";
  echo getRecommendation($user);
} else {
  //echo "Responding to $msg <br />";
  echo getResponse($msg, $user);
}
