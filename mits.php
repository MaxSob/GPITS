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
  }

  //This function obtains user context
  function getUserContext($user) {
    return $this->contexts[$user];
  }

  //This fucntion updates the context for a user
  function updateUserContext($user, $context) {
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
    $query = $this->constructQuery($query);
    if(count($query->fields) == 0)
      $query->addField('nombre', 'CONVERSATION');
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
