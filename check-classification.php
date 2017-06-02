<?php
include_once("gpits_core.php");
include_once("XmlDriver.php");
include_once("MoodleToolsDomainKnowledge.php");
include_once("mits.php");
include_once("StringUtils.php");

$file1 = "./examples/examples.txt";
$profiler = new MITSUserProfiler();
$lines = file($file1);
$positives = 0;
foreach($lines as $line_num => $line) {
  echo $line;
  echo "<br>";
  $features = explode(",", $line);
  $e = array();

  for($i=0; $i< 10; $i++)
    $e[]= ($features[$i] * 1);

  $profile = $profiler->decideUserProfileFromData($e);
  echo "Selected profile " . $profile["profile"] . " classified profile " . $features[10] . "<br />";
  if($profile["profile"]*1 == $features[10]){
    $positives += 1;
    echo "Example $line_num correct <br />";
  } else {
    echo "Example $line_num is INCORRECT!!! <br />";
  }
}

echo "Positive examples " .  $positives . "<br />";
?>
