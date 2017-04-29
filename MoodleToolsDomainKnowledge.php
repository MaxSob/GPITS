<?php
class MoodleToolsDomainKnowledge extends DomainKnowledge {
  protected $config = '';
  public $data = '';
  //The key property identifies the object which is intended to access by the user
  //For Mooodle Tools the name of the tool is the key to know the tool that the user is
  //Quering about. The properties to get is the atribute of the object that the user is
  //asking for.
  public $key_property = 'nombre';

  function __construct() {
    $this->config = './conf/keyword.xml';
    $this->loadConfig();
  }

  function loadConfig() {
    if(file_exists($this->config)) {
      $this->data = simplexml_load_file($this->config);
    }
    /*foreach ($this->data as $property) {
      echo $property->nombre . "<br />";
      foreach ($property->sinonyms->sinonym as $s) {
        echo $s . "<br />";
      }
    }*/
  }

  function generateQuery($raw_query) {
    $q = new Query();
    $q->raw_data = $raw_query;
    foreach ($this->data as $property) {
      foreach ($property->sinonyms->sinonym as $s)
        if($this->isKeywordInString($raw_query, $s)) {
          if($property->key == $this->key_property)
            $q->addField($this->key_property, $s);
          else
            $q->get_property = $property->key;
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

  function getEntitesNames() {
    $entites = array();
    foreach ($this->data as $property) {
      foreach ($property->sinonyms->sinonym as $s)
      $entites[] = $s;
    }
    return $entities;
  }

}
