<?php
class DomainKnowledge {
  protected $config = '';
}

class Field {
  public $name;
  public $value;
}

class Query {
  public $raw_data = '';
  public $get_property = '';
  public $fields = array();

  function __construct() {
    $this->fields = array();
  }

  function addField($name, $value=null) {
    $f = new Field();
    $f->name = $name;
    $f->value = $value;
    $this->fields[] = $f;
  }

  protected function getQuery() {
    return $this->raw_data;
  }
}

abstract class Driver {
  protected $base = "";
  abstract protected function connect();
  abstract protected function runQuery($query);
}
