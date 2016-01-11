<?php
namespace sampleMessageBoard\application\controller;
use DoctrineExtensions\NestedSet\Manager;
use DoctrineExtensions\NestedSet\Config;

class PostController extends BaseController{
  public function create($params){
    $model = new $this->model();
    $nsm = new Manager(new Config($this->entityManager, $this->model));

    foreach($params as $k => $v){
      $f = 'set' . ucfirst($k);
      if(method_exists($model, $f)){
        $model->$f($v);
      }
    }
    if($model->getParentId() > 0){
      // add new post as a child of another post
      $parent = $nsm->fetchTree($model->getParentId());
      $parent->addChild($model);
      return $model;
    } else {
      $nsm->createRoot($model);
      return $model;
    }
  }
  public function get($id){
    return $this->entityManager->getRepository($this->model)->find($id);

  }
  public function getThread($root_id){
    $nsm = new Manager(new Config($this->entityManager, $this->model));
    $model = $nsm->wrapNode($this->entityManager($this->model)->find($root_id));
    return $model->getChildren();
    //return $this->entityManager->getRepository($this->model)->getPostThread($root_id);
  }
  public function index($board_id){
    return $this->entityManager->getRepository($this->model)->findBy(array('board_id' => $board_id, 'parent_id' => 0));
  }
  public function update($id, $params){
    $model = $this->entitymanager->getRepository($this->model)->find($id);
    if($model){
      foreach($params as $k => $v){
        $f = 'set' . ucfirst($k);
        if(method_exists($model, $f)){
          $model->$f($v);
        }
      }
    }
    $this->entityManager->presist($model);
  }
  public function remove($id){
    $model = $this->entityManager->getRepository($this->model)->find($id);
    $this->entityManager->remove($model);
  }
}
?>
