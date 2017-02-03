<?php
class XmlDriver extends Driver {
  protected $objects = null;

  public function __construct() {
      $this->base = "./conf/base.conf";
      $this->connect();
  }

  function connect() {
    $this->objects = array();
    $conf = fopen($this->base, 'r');
    while(($line = fgets($conf)) != false) {
      $tool = trim('./conf/' . $line);
      if(file_exists($tool)) {
        $xml = simplexml_load_file($tool);
        $this->objects[] = $xml;
      } else {
        echo $tool . ' No existe... <br />';
      }
    }
  }

  function runQuery($query) {
    if($this->objects != null) {
      foreach($this->objects as $o) {
        $match = true;
        foreach ($query->fields as $f)
          if(strtoupper($o->{$f->name}) != strtoupper($f->value))
            $match = false;
        //If every property matched we have the object and we get the property
        if($match)
          return (string) $o->{$query->get_property};
      }
    }
    return null;
  }
}
