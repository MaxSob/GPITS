<?php
class MoodleToolsDomainKnowledge extends DomainKnowledge {
  protected $config = '';
  public $data = '';
  public $conversations_keys;
  //The key property identifies the object which is intended to access by the user
  //For Mooodle Tools the name of the tool is the key to know the tool that the user is
  //Quering about. The properties to get is the atribute of the object that the user is
  //asking for.
  public $key_property = 'nombre';

  function __construct() {
    $this->config = './conf/keyword.xml';
    $this->loadConfig();
    $this->conversations_keys = array('que_eres', 'despedida', 'robot', 'dime_algo');
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
          //echo "************************$s está presente en $raw_query *************************** <br />";
          if($property->key == $this->key_property)
            $q->addField($this->key_property, $s);
          else
            $q->get_property = $property->key;
      }
    }

    if(in_array($q->get_property, $this->conversations_keys))
      $q->setField('nombre', 'CONVERSATION');
    return $q;
  }

  function containsKeyword($string, $array) {
      foreach($array as $v)
        if(strpos(strtoupper(" " . $string), strtoupper($v)) != false)
          return true;
    return false;
  }

  function isKeywordInString($string, $keyword) {
    $tiger_jump = 0.3;
    if(count($keyword) < 5)
      $tiger_jump = 0.2;
    $similitud = compareWords(prepareString($string), prepareString($keyword));
    $s = $similitud['score'];
    //echo "$s con $keyword <br />";
    //echo substr($string, $similitud['index'], $similitud['final_index'] - $similitud['index']) . '<br />';
    if($s < $tiger_jump)
      return true;
    return false;
  }

  function isKeywordInStringOld($string, $keyword) {
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
