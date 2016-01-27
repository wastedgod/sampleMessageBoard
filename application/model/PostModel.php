<?php
namespace sampleMessageBoard\application\model;
use DoctrineExtensions\NestedSet\MultipleRootNode;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity(repositoryClass="sampleMessageBoard\application\repository\PostRepository")
* @ORM\HasLifecycleCallbacks
* @ORM\Table(name="posts")
**/
class PostModel extends BaseModel implements MultipleRootNode, iTreeNode{
  // public function setUp(){
  //   $this->actAs('NestedSet', array(
  //     'hasManyRoots' => true,
  //     'rootColumn' => 'root_id'
  //   ));
  // }
  /**
  * @ORM\Id
  * @ORM\Column(type="integer")
  * @ORM\GeneratedValue
  **/
  protected $id;

  /**
  * @ORM\Column(type="integer")
  **/
  protected $root;

  /**
  * @ORM\Column(type="integer")
  **/
  protected $user_id;

  /**
  * @ORM\Column(type="integer")
  * @ORM\ManyToOne(targetEntity="BoardModel")
  **/
  protected $board_id;

  /**
  * @ORM\Column(type="string")
  **/
  protected $title;

  /**
  * @ORM\Column(type="string")
  **/
  protected $message;

  /**
  * @ORM\Column(type="boolean")
  **/
  protected $active;

  /**
  * @ORM\Column(type="integer")
  * @ORM\ManyToOne(targetEntity="PostModel")
  **/
  protected $parent_id;

  /**
  * @ORM\Column(type="integer")
  **/
  protected $lft;

  /**
  * @ORM\Column(type="integer")
  **/
  protected $rgt;

  /**
  * @ORM\Column(type="datetime")
  **/
  protected $created;

  /**
  * @ORM\Column(type="datetime")
  **/
  protected $modified;

  public function __toString(){
    return $this->title;
  }
  ##############################################################################
  # Setters
  ##############################################################################
  public function setId($id){
    $this->id = $id;
  }
  public function setUserId($id){
    $this->user_id = $id;
  }
  public function setBoardId($id){
    $this->board_id = $id;
  }
  public function setTitle($title){
    $this->title = $title;
  }
  public function setMessage($message){
    $this->message = $message;
  }
  public function setActive($status){
    $this->active = $status == true ? true : false;
  }
  public function setParentId($id){
    $this->parent_id = $id;
  }
  //public function setLft($lft){
  public function setLeftValue($lft){
    $this->lft = $lft;
  }
  //public function setRgt($rgt){
  public function setRightValue($rgt){
    $this->rgt = $rgt;
  }
  public function setCreated($created){
    $this->created = $created;
  }
  public function setModified($modified){
    $this->modified = $modified;
  }
  public function setRootValue($root){
    $this->root = $root;
  }

  ##############################################################################
  # Getters
  ##############################################################################
  public function getId(){ return $this->id; }
  public function getUserId(){ return $this->user_id; }
  public function getParentId(){ return $this->parent_id; }
  public function getBoardId(){ return $this->board_id; }
  public function getTitle(){ return $this->title; }
  public function getMessage(){ return $this->message; }
  public function getActive(){ return $this->active; }
  public function getCreated(){ return $this->created; }
  public function getModified(){ return $this->modified; }
  public function getLeftValue(){ return $this->lft; }
  public function getRightValue(){ return $this->rgt; }
  public function getRootValue(){ return $this->root; }


  public function toArray(){
    return array(
      'id'=> $this->id,
      'userId' => $this->user_id,
      'boardId' => $this->board_id,
      'title' => $this->title,
      'message' => $this->message,
      'active' => $this->active,
      'created' => $this->created,
      'modified' => $this->modified,
    );
  }


}
?>
