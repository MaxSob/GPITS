<?php
//Singleton implementation of the MemoryManagerFactory
final class MemoryManagerFactory {
    /**
     * Call this method to get singleton
     *
     * @return MemoryManager
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new MITSMemoryManager();
        }
        return $inst;
    }

    private function __construct() { }

    private function __clone() {}
}

class MITSMemoryManager extends MemoryManager {
  public $contexts;


  function __construct() {
    $this->contexts = array();
    $this->getContexts();
  }

  //This function returns a database connection
  function getConnection() {
    $user = "mits_user";
    $host = "localhost";
    $password = "mits";
    $database = "mits";
    $connection = mysqli_connect($host, $user, $password, $database);
    return $connection;
  }
  //This function loads the contexts in memory
  function getContexts() {
    $connection = $this->getConnection();
    //$query = "Select * from contexts Where date >= "
    $query = "Select * from contexts";
    $result = mysqli_query($connection, $query);
    while($data = mysqli_fetch_array($result)) {
      $this->contexts[$data['id_user']] = array("intention" => $data["intention"], "entity" => $data["entity"]);
    }
    return true;
  }

  function insertUser($user) {
    $connection = $this->getConnection();
    $query = "Select * from contexts where id_user = $user";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) == 0) {
      $date = date("Y-m-d h:i:s");
      $insert = "Insert into contexts Values(NULL, '$user', '', '', '$date')";
      mysqli_query($connection, $insert);
      return true;
    }
    return false;
  }

  //This function obtains user context
  function getUserContext($user) {
    $context = (isset($this->contexts[$user]))?$this->contexts[$user]:null;
    if($context == null) {
      $context = array("entity" => '', "intention" => '');
      $this->contexts[$user] = $context;
    }
    return $context;
  }

  //This fucntion updates the context for a user
  function updateUserContext($user, $context) {
    $this->insertUser($user);
    $connection = $this->getConnection();
    $intention = $context["intention"];
    $entity = $context["entity"];
    $date = date("Y-m-d h:i:s");
    $query = "Update contexts set intention='$intention', entity='$entity', date='$date' Where id_user = '$user'";
    mysqli_query($connection, $query);
    $this->contexts[$user] = $context;
  }
}

//EntityExtractor for the MITS system
class MITSEntityExtractor extends EntityExtractor {

  //MITSEntityExtractor constructor
  function __construct() {
    $this->entites = array();
    //We establish a connection to the domain knowledge to get the entities
    $domain = new MoodleToolsDomainKnowledge();
    $names = $domain->getEntitesNames();
    foreach ($names as $name) {
      $e =  new Entity();
      $e->type = 'String';
      $e->name = 'Moodle Tool';
      $e->instance = $name;
      $this->entities[] = $e;
    }
  }

  //Function to extract entities for the query
  public function extractEntities($query) {

  }
}

class MITSController extends ChatBotController {

  public function processQuery($query, $user) {
    $mm = new MITSMemoryManager();
    $context = $mm->getUserContext($user);
    $query = $this->constructQuery($query);
    if(count($query->fields) == 0) {
      if($context["entity"] == "")
        $query->addField('nombre', 'CONVERSATION');
      else
        $query->addField('nombre', $context["entity"]);
    } else {
      $context["entity"] = $query->getField("nombre");
    }

    if($query->get_property == null) {
      if($context["intention"] != "")
        $query->get_property = $context["intention"];
    } else {
      $context["intention"] = $query->get_property;
    }

    $mm->updateUserContext($user, $context);

    $driver = new XmlDriver();
    $data = $driver->runQuery($query);
    if($data == null || $data == '')
      $data = "Puedes reformular la pregunta?";

    return json_encode(['respuesta'=> $data]);
  }

  public function constructQuery($raw) {
    $domain = new MoodleToolsDomainKnowledge();
    return $domain->generateQuery($raw);
  }
}
