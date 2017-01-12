<?php
class XmlDriver extends Driver {
  protected $base = "";
  protected $object = null;
  protected $objects = null;

  public function __construct() {
      $this->base = "knowledgebase.xml";
      if (file_exists('knowledgebase.xml')) {
        $this->object = simplexml_load_file($this->base);
        $this->objects = array($this->object);
      }
  }

  function runQuery($query) {
    if($this->objects != null) {
      foreach($this->objects as $o) {
        $match = true;
        foreach ($query->fields as $name => $value) {
          if($o->$name != $value)
            return null;
        }
        if($match)
          return $o->{$query->getProperty};
      }
    }
  }
}
