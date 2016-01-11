<?php
namespace sampleMessageBoard\application\controller;
class BoardController extends BaseController{

  public function get($id){
    return $this->entityManager->getRepository($this->model)->find($id);
  }
  public function index(){
    return $this->entityManager->getRepository($this->model)->findAll();
  }
  public function update($id, $params){
    $model = $this->entityManager->getRepository($this->model)->find($id);
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
  public function create($params){
    $model = new $this->model();
    foreach($params as $k => $v){
      $f = 'set' . ucfirst($k);
      if(method_exists($model, $f)){
        $model->$f($v);
      }
    }
    $this->entityManager->persist($model);
    return $model->getId();
  }
  public function remove($id){
    $model = $this->endityManager->getRepository($this->model)->find($id);
    $this->entityManager->remove($model);
  }
}
?>
