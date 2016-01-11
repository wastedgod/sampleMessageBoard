<?php
namespace sampleMessageBoard\application\model;
use DoctrineExtensions\NestedSet\MultipleRootNode;
/**
* @Entity(repositoryClass="sampleMessageBoard\application\repository\PostRepository")
* @HasLifecycleCallbacks
* @Table(name="posts")
**/
//class PostModel extends Doctrine_Record implements iModel{
class PostModel extends BaseModel implements MultipleRootNode{
  // public function setUp(){
  //   $this->actAs('NestedSet', array(
  //     'hasManyRoots' => true,
  //     'rootColumn' => 'root_id'
  //   ));
  // }
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /** @Column(type="integer") **/
  protected $root;

  /** @Column(type="integer") **/
  protected $user_id;

  /**
  * @Column(type="integer")
  * @ManyToOne(targetEntity="BoardModel")
  **/
  protected $board_id;

  /** @Column(type="string") **/
  protected $title;

  /** @Column(type="string") **/
  protected $message;

  /** @Column(type="boolean") **/
  protected $active;

  /**
  * @Column(type="integer")
  * @ManyToOne(targetEntity="PostModel")
  **/
  protected $parent_id;

  /** @Column(type="integer") **/
  protected $lft;

  /** @Column(type="integer") **/
  protected $rgt;

  /** @Column(type="datetime") **/
  protected $created;

  /** @Column(type="datetime") **/
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

  ##############################################################################
  # listeners
  # note - use the classes under the listener directory for 99% of the cases
  ##############################################################################
  // some event listeners for create / update to set the created / modified fields
	/**
	* @PrePersist
	* sets the created and modified date time to now on record create
	**/
	public function setCreateDates(){
		$t = date_create(date('Y-m-d H:i:s'));
		$this->created = $t;
		$this->modified = $t;
	}
	/**
	* @PreUpdate
	* sets the modified date time to now on update
	**/
	public function setUpdateDates(){
		$this->modified = date_create(date("Y-m-d H:i:s"));
	}
}
?>
