<?php
$conf = fopen('./conf/base.conf', 'r');
$data = array();
while(($line = fgets($conf)) != false) {
  $tool = trim('./conf/' . $line);
  if(file_exists($tool)) {
    $xml = simplexml_load_file($tool);
    $data[] = $xml;
  } else {
    echo $tool . ' No existe... <br />';
  }
}
//echo var_dump($data) . '<br />';

foreach ($data as $d)
  echo var_dump($d) . '<br />';
?>
