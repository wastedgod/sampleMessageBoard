<?php
namespace sampleMessageBoard\application\repository;

use DoctrineExtensions\NestedSet\Manager;
use DoctrineExtensions\NestedSet\Config;
use Doctrine\ORM\EntityRepository;
use sampleMessageBoard\application\model\iModel;

public abstract TreeRepository extends BaseRepository{
  /**
  * override BaseRepository->create function for nested set tree
  **/
  public function create(iTreeNode $model){
    $nsm = new Manager(new Config($this->getEntityManager(), $model));
    if($model->getParentId() > 0){
      // add new post as a child of another post
      $parent = $nsm->fetchTree($model->getParentId());
      $parent->addChild($model);
    } else {
      $nsm->createRoot($model);
    }
  }
  public function remove(iTreeNode $model){
    $nsm = new Manager( new Config($this->getEntityManager(), $model));
    $node = $nsm->wrapNode($model);
    $node->delete();
  }

  /*****************************************************************************
  * with the repository pattern we don't want to expose the underlying db to the
  * controller, so the controller does not have access to the entity manager.
  * These methods allow the controller to access the nested set tree move methods
  * which have the same method name.
  ******************************************************************************/
  public function moveAsLastChildOf(iTreeNode $model, iTreeNode $parentModel){
    $nsm = new Manager(new Config($this->getEntityManager(), $model));
    $node = $nsm->wrapNode($model);
    $node->moveAsLastChildOf($parentNode);
  }
  public function moveAsFirstChildOf(iTreeNode $model, iTreeNode $parentModel){
    $nsm = new Manager(new Config($this->getEntityManager(), $model));
    $node = $nsm->wrapNode($model);
    $node->moveAsFirstChildOf($parentModel);
  }
  public function moveAsPrevSiblingOf(iTreeNode $model, iTreeNode $parentModel){
    $nsm = new Manager(new Config($this->getEntityManager(), $model));
    $node = $nsm->wrapNode($model);
    $node->moveAsPrevSiblingOf($parentModel);
  }
  public function moveAsNextSiblingOf(iTreeNode $model, iTreeNode $parentModel){
    $nsm = new Manager(new Config($this->getEntityManager(), $model));
    $node = $nsm->wrapNode($model);
    $node->moveAsNextSiblingOf($parentNode);
  }
  public function addChildTo(iTreeNode $model, $parentId){
    $nsm = new Manager(new Config($this->getEntityManager(), $model));
    $nsm->fetchTree($parentId);
      ->addChild($model);
  }
  public function createRoot(iTreeNode $model){
    $nsm = new Manager(new Config($this->getEntityManager(), $model));
    $nsm->createRoot($model);
  }
}
?>
