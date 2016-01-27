<?php
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping as ORM;
namespace sampleMessageBoard\application\model;
/**
* @ORM\Entity(repositoryClass="sampleMessageBoard\application\repository\UserRepository")
* @ORM\HasLifecycleCallbacks
* @ORM\Table(name="users")
**/
class UserModel extends BaseModel implements iModel{
  /**
  * @ORM\Id
  * @ORM\Column(type="integer")
  * @ORM\GeneratedValue
  **/
  protected $id;

  /**
  * @ORM\Column(type="integer")
  **/
  protected $auth_id;

  /**
  * @ORM\Column(type="integer");
  **/
  protected $provider_id;
  /**
  * @ORM\Column(type="boolean")
  **/
  protected $active;

  /**
  * @ORM\Column(type="integer")
  **/
  protected $role_id;

  /**
  * @ORM\Column(type="datetime")
  **/
  protected $created;

  /**
  * @ORM\Column(type="datetime")
  **/
  protected $modified;

  ##############################################################################
  # Setters
  ##############################################################################
  public function setId($id){
    $this->id = $id;
  }
  public function setUsername($username){
    $this->username = $username;
  }
  public function setActive($status){
    $this->active = $status == true ? true : false;
  }
  public function setPassword($password){
    $this->password = $password;
  }
  public function setCreated($created){
    $this->created = $created;
  }
  public function setModified($modified){
    $this->modified = $modified;
  }

  ##############################################################################
  # getters
  ##############################################################################
  public function getId(){
    return $this->id;
  }
  public function getUsername(){
    return $this->username;
  }
  public function getPassword(){
    return $this->password;
  }
  public function getActive(){
    return $this->active;
  }
  public function getCreated(){
    return $this->created;
  }
  public function getModified(){
    return $this->modified;
  }


  public function toArray(){
    return array(
      'id' => $this->id,
      'username' => $this->username,
      'created' => $this->created,
      'modified' => $this->modified
    );
  }

  // ##############################################################################
  // # listeners
  // # note - use the classes under the listener directory for 99% of the cases
  // ##############################################################################
  // // some event listeners for create / update to set the created / modified fields
	// /**
	// * @PrePersist
	// * sets the created and modified date time to now on record create
	// **/
	// public function setCreateDates(){
	// 	$t = date_create(date('Y-m-d H:i:s'));
	// 	$this->created = $t;
	// 	$this->modified = $t;
	// }
	// /**
	// * @PreUpdate
	// * sets the modified date time to now on update
	// **/
	// public function setUpdateDates(){
	// 	$this->modified = date_create(date("Y-m-d H:i:s"));
	// }

}
?>
