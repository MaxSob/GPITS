<?php
include_once("gpits_core.php");
include_once("XmlDriver.php");
include_once("MoodleToolsDomainKnowledge.php");
include_once("mits.php");
include_once("StringUtils.php");

function getLine() {
  $tools = 10;
  $use = '';
  for($i=0; $i<$tools; $i++)
    $use .= floor(rand(1, 5)) . ",";
  return $use;
}
$examples = 30;
$myfile = fopen("./examples/examples.txt", "w") or die("Unable to open file!");
for($i=0; $i < $examples; $i++) {
  $line = getLine() . "-1\n";
  echo $line;
  echo "<br />";
  fwrite($myfile, $line);
}
fclose($myfile);
 ?>
