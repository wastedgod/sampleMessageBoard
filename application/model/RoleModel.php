<?php
namespace sampleMessageBoard\application\model;
use DoctrineExtensions\NestedSet\MultipleRootNode;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping as ORM;
class RoleModel extends BaseModel implements MultipleRootNode, iTreeNode{

  /**
  * @ORM\Id
  * @ORM\Column(type="integer")
  * @ORM\GeneratedValue
  **/
  protected $id;

  /**
  * @ORM\Column(type="string")
  **/
  protected $role;

  /**
  * @ORM\Column(type="integer")
  **/
  protected $parent_id;

  /**
  * @ORM\Column(type="integer")
  **/
  protected $root_id;

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

  ##############################################################################
  # Getters
  ##############################################################################
  public function getId(){ return $this->id; }
  public function getRole(){ return $this->role; }
  public function getParentId(){ return $this->parent_id; }
  public function getRootValue(){ return $this->root_id; }
  public function getLft(){ return $this->lft; }
  public function getRgt(){ return $this->rgt; }
  public function getCreated(){ return $this->created; }
  public function getModified(){ return $this->modified; }

  ##############################################################################
  # Setters
  ##############################################################################
  public function setId($id){
    $this->id = $id;
    return $this;
  }
  public function setParentId($parent_id){
    $this->parent_id = $parent_id;
    return $this;
  }
  public function setRootValue($root_id){
    $this->root_id = $root_id;
    return $this;
  }
  public function setLft($lft){
    $this->lft = $lft;
    return $this;
  }
  public function setRgt($rgt){
    $this->rgt = $rgt;
    return $this;
  }
  public function setCreated($created){
    $this->created = $created;
    return $this;
  }
  public function setModified($modified){
    $this->modified = $modified;
    return $this;
  }
}
?>
