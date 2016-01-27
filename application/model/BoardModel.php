<?php
namespace sampleMessageBoard\application\model;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity(repositoryClass="sampleMessageBoard\application\repository\BoardRepository")
* @ORM\HasLifecycleCallbacks
* @ORM\Table(name="boards")
**/
class BoardModel extends BaseModel{
  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="IDENTITY")
   */
  protected $id;

  /**
  * @var string
  *
  * @ORM\Column(name="title", type="string")
  **/
  protected $title;

  /**
  * @var integer
  *
  * @ORM\Column(name="owner_id", type="integer")
  **/
  protected $owner_id;

  /**
  * @ORM\Column(name="created", type="datetime")
  **/
  protected $created;

  /**
  * @ORM\Column(name="modified", type="datetime")
  **/
  protected $modified;

  ##############################################################################
  # setters
  ##############################################################################
  public function setTitle($title){
    $this->title = $title;
  }

  public function setOwnerId($owner_id){
    $this->owner_id = $owner_id;
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
  public function getId(){ return $this->id; }
  public function getTitle(){ return $this->title; }
  public function getOwnerId(){ return $this->owner_id; }
  public function getCreated(){ return $this->created; }
  public function getModified(){ return $this->modified; }


  public function toArray(){
    $ret = array(
      'id' => $this->id,
      'title' => $this->title,
      'ownerId' => $this->owner_id,
      'created' => $this->created,
      'modified' => $this->modified
    );
    return $ret;
  }
}
?>
