<?php
class ProviderContoller extends BaseController{
  public function get($id){

  }
  public function index(){

  }
  public function getConfigArray(){
    return $this->entityManager->getRepository($this->model)->getIndexAsArray();
  }
}
?>
