<?php
namespace sampleMessageBoard\application\controller;
use DoctrineExtensions\NestedSet\Manager;
use DoctrineExtensions\NestedSet\Config;

class PostController extends BaseController{
  public function create($params){
    $model = new $this->model();
    foreach($params as $k => $v){
      $f = 'set' . ucfirst($k);
      if(method_exists($model, $f)){
        $model->$f($v);
      }
    }
    if($model->getParentId() > 0){
      $this->repository->addChild($model, $model->getParentId());
      return $model;
    } else {
      $this->repository->createRoot($model);
      return $model;
    }
  }
  public function get($id){
    return $this->entityManager->getRepository($this->model)->find($id);
  }
  public function getThread($root_id){
    return $this->repository->getPostThread($root_id);

    // $nsm = new Manager(new Config($this->entityManager, $this->model));
    // $model = $nsm->wrapNode($this->entityManager->getRepository($this->model)->find($root_id));
    // $children =  $model->getChildren();
    // foreach($children as $c){
    //   $ret[] = $c->getNode()->toArray();
    // }
    // return $ret;
    //return $this->entityManager->getRepository($this->model)->getPostThread($root_id);
  }
  public function getBoardPosts($board_id){
    return $this->repository->getBoardPosts($board_id);
  }
  public function index($board_id){
    return $this->repository->findBy(array('board_id' => $board_id, 'parent_id' => 0));
  }
  public function update($id, $params){
    $model = $this->repository->find($id);
    if($model){
      foreach($params as $k => $v){
        $f = 'set' . ucfirst($k);
        if(method_exists($model, $f)){
          $model->$f($v);
        }
      }
    }
    $this->repository->update($model);
  }
  public function remove($id){
    $this->repository->delete($this->repository->find($id));
    return;
    // $nsm = $nsm = new Manager(new Config($this->entityManager, $this->model));
    // $model = $nsm->wrapNode($this->entityManager->getRepository($this->model)->find($id));
    // $model->delete();
  }
}
?>
