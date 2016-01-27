<?php
namespace sampleMessageBoard\application\controller;
class BoardController extends BaseController{

  public function get($id){
    return $this->repository($this->model)->find($id);

  }
  public function index($asArray = true){
    return $this->repository($this->model)->getIndexAsArray();
    // return $this->entityManager->getRepository($this->model)
    //   //->findAll();
    //   ->createQueryBuilder('b')
    //   ->select('b')
    //   ->getQuery()
    //   ->getResult($asArray
    //     ? \Doctrine\ORM\Query::HYDRATE_ARRAY
    //     : \Doctrine\ORM\Query::HYDRATE_OBJECT
    //   );
  }
  public function update($id, $params){
    $model = $this->repository($this->model)->find($id);
    if($model){
      foreach($params as $k => $v){
        $f = 'set' . ucfirst($k);
        if(method_exists($model, $f)){
          $model->$f($v);
        }
      }
    }
    $this->repository->updateBoard($model);
    //$this->entityManager->presist($model);
  }
  public function create($params){
    $model = new $this->model();
    foreach($params as $k => $v){
      $f = 'set' . ucfirst($k);
      if(method_exists($model, $f)){
        $model->$f($v);
      }
    }
    $this->repository($this->model)->createNewBoard($model);
    // $this->entityManager->persist($model);
    // $this->entityManager->flush();
    return $model;
  }
  public function remove($id){
    $model = $this->repository($this->model)->find($id);
    $this->entityManager->remove($model);
  }
}
?>
