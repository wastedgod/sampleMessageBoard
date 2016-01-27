<?php
namespace sampleMessageBoard\application\controller;
class UserController extends BaseController{
  public function create(){

  }

  public function get($id){
    return $this->entityManager->getRepository($this->model)->find($id);
  }

  public function index(){
    return $this->entityManager->getRepository($this->model)->findAll()
  }

  public function update($id, $params){
    $noUpdate = array('id', 'password');
    $model = $this->entityManager->getRepository($this->model)->find($id);
    foreach($params as $k => $v){
      if(!in_array($k, $noUpdate)){
        $f = 'set' . ucfirst($k);
        if(method_exists($model, $f)){
          $model->$f($v);
        }
      }
    }
    $this->entityManager->presist($model);
  }
  // public function logIn($username, $password){
  //
  //   $model = $this->entityManager->getRepository($this->model)->findBy(array('username' => $username));
  //   $hashedPass = $this->hashPassword($password, $model->getSalt(), $model->created);
  //   if($model->password === $hashedPass){
  //     $this->sessionManager->setUser($model);
  //     return true;
  //   }
  //   return false;
  // }
  // public function changePassword($id, $newPassword){
  //
  // }

  public function remove($id){

  }

  // private function hashPassword($pass, $salt, $pepper, $hashType = 'MD5'){
  //
  // }
}
?>
