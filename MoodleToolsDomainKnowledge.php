<?php
class MoodleToolsDomainKnowledge extends DomainKnowledge {
  public $data = '';
  public $key_property = 'nombre';

  function __construct() {
    $this->config = './conf/keyword.conf';
    $this->loadConfig();
  }

  function loadConfig() {
    if(file_exists($this->config)) {
      $this->data = simplexml_load_file($this->config);
    }
    foreach ($this->data as $propiedad) {
      echo $propiedad->nombre . "<br />";
      foreach ($propiedad->sinonimos->sinonimo as $s) {
        echo $s . "<br />";
      }
    }
  }

  function generateQuery($raw_query) {
    $q = new Query();
    foreach ($this->data as $propiedad) {
      foreach ($propiedad->sinonimos->sinonimo as $s)
        if($this->isKeywordInString($raw_query, $s)) {
          if($propiedad->nombre == $this->key_property)
            $q->addField($this->key_property, $s);
          else
            $q->get_property = $propiedad->nombre;
        echo " Added " . $propiedad->nombre . " for word " . $s;
      }
    }
    return $q;
  }

  function containsKeyword($string, $array) {
      foreach($array as $v)
        if(strpos(strtoupper(" " . $string), strtoupper($v)) != false)
          return true;
    return false;
  }

  function isKeywordInString($string, $keyword) {
    if(strpos(strtoupper(" " . $string), strtoupper($keyword)) != false)
      return true;
    return false;
  }
}
