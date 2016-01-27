<?php
namespace sampleMessageBoard\application\controller;
use DoctrineExtensions\NestedSet\Manager;
use DoctrineExtensions\NestedSet\Config;

class RoleController extends BaseController{
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
  public function getFull($id){
    $nsm = new Manager(new Config($this->entityManager, $this->model));
    $node = $nsm->$nsm->wrapNode($this->get($id));
    return array_push($node, $node->getChildren());
  }
}
?>
