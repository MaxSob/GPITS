<?php
/*Chatbot Classes*/
class Entity {
  protected $type;
  protected $name;
  protected $instance;
}

class Context {
  protected $path;
  protected $entities;
}

abstract class MemoryManager {
  public abstract function getUserContext($user);
  public abstract function updateUserContext($user, $context);
}

abstract class EntityExtractor {
  protected  $entities;
  public abstract function extractEntities($query);
}

abstract class ChatBotController {
  public abstract function processQuery($query, $user);
  public abstract function constructQuery($raw);
}


/*Domain Knowledge Access Classes*/
class Field {
  public $name;
  public $value;

  public function __construct($name=null, $value=null) {
    $this->name = $name;
    $this->value = $value;
  }

}

class Query {
  public $raw_data = null;
  public $get_property = null;
  public $fields;

  function __construct($raw_data = null) {
    $this->raw_data = $raw_data;
    $this->fields = array();
  }

  function addField($name, $value=null) {
    $f = new Field($name, $value);
    $this->fields[] = $f;
  }

  function getField($name) {
    foreach ($this->fields as $f) {
      if($f->name == $name)
        return $f->value;
    }
    return null;
  }

  public function __toString() {
    $return = "Get property: " . $this->get_property . " ";
    foreach ($this->fields as $f) {
      $return .= $f->name . " : " . $f->value . " ";
    }
    return $return;
  }

  public function setField($name, $value) {
    $this->fields = array();
    $this->addField($name, $value);
  }

  public function hasField($name, $value) {
    foreach ($this->fields as $f) {
      if($f->name == $name && $f->value == $value)
        return true;
    }
    return false;
  }
}


abstract class Driver {
  protected $base = "";
  abstract protected function connect();
  abstract protected function runQuery($query);
}


abstract class DomainKnowledge {
  abstract protected function generateQuery($raw_query);
}


/*ITS Classes*/
class Request {
  public $raw_query;
  public $user;

  public function __construct($raw_query=null, $user=null) {
    $this->raw_query = $raw_query;
    $this->user = $user;
  }
}

abstract class Response {
  public $attributes;

  public function __construct($attributes = null) {
    if($attributes == null)
      $this->attributes = array();
    else
      $this->attributes = $attributes;
  }

  public abstract function format();
}

abstract class Tutor {
  public abstract function decideFedBack();
  public abstract function attendRequest($request);
}

/*User profiles classes*/
abstract class User {}

class UserProfile {
  protected $name;
  protected $description;
  protected $attributes;

  public function __construct($name=null, $description = null, $attributes = null) {
    $this->name = $name;
    $this->description = $description;
    if($attributes == null)
      $this->attributes = array();
    else
      $this->attributes = $attributes;
  }

}

abstract class UserProfiler {
  public abstract function decideUserProfile($user);
}
