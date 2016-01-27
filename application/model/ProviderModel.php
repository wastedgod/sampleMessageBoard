<?php
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity(repositoryClass="sampleMessageBoard\application\repository\ProviderRepository")
* @ORM\HasLifecycleCallbacks
* @ORM\Table(name="providers")
**/
class ProviderModel extends BaseModel{
  /**
  * @ORM\Id
  * @ORM\Column(type="integer")
  * @ORM\GeneratedValue
  **/
  protected $id;

  /**
  * @ORM\Column(type="string")
  **/
  protected $key;

  /**
  * @ORM\Column(type="string")
  **/
  protected $secret;

  /**
  * @ORM\Column(type="simple_array")
  **/
  protected $requestAccess;

  /**
  * @ORM\Column(type="string")
  **/
  protected $requestPath;

  /**
  * @ORM\Column(type="datetime")
  **/
  protected $created;

  /**
  * @ORM\Column(type="datetime")
  **/
  protected $modified;

  ##############################################################################
  # Getters
  ##############################################################################
  public function getId(){
    return $this->id;
  }
  public function getKey(){
    return $this->key;
  }
  public function getSecret(){
    return $this->secret;
  }
  public function getRequestAccess(){
    return $this->requestAccess;
  }
  public function getRequestPath(){
    return $this->requestPath;
  }
  public function getCreated(){
    return $this->created;
  }
  public function getModified(){
    return $this->modified;
  }

  ##############################################################################
  # Setters
  ##############################################################################
  public function setId($id){
    $this->id = $id;
  }
  public function setKey($key){
    $this->key = $key;
  }
  public function setSecret($secret){
    $this->secret = $secret;
  }
  public function setRequestAccess($requestAccess){
    $this->requestAccess = $requestAccess;
  }
  public function setRequestPath($requestPath){
    $this->requestPath = $requestPath;
  }
  public function setCreated($created){
    $this->created = $created;
  }
  public function setModified($modified){
    $this->modified = $modified;
  }

  public function toArray(){
    return [
      'id' => $this->id,
      'key' => $this->key,
      'secret' => $this->secret,
      'requestAccess' => $this->requestAccess,
      'c'
    ]
  }
}
?>
