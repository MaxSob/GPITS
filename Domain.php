<?php
class DomainKnowledge {

  function __toString() {
    return 'Data';
  }
}

class Field {
  public $name;
  public $value;
}

class Query {
  public $raw_data = '';
  public $getProperty = '';
  public $fields = array();

  function __construct() {
    $this->fields = array();
  }

  function addField($name, $value=null) {
    $f = new Field();
    $f->name = $name;
    $f->value = $value;
  }

  protected function getQuery() {
    return $this->raw_data;
  }
}

abstract class Driver {
  abstract protected function runQuery($query);
}
