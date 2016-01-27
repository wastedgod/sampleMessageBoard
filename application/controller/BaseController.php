<?php
namespace sampleMessageBoard\application\controller;
use Doctrine\ORM\EntityManager;
use sampleMessageBoard\application\repository\iRepository;
abstract class BaseController implements iController{
  protected $model;
  protected $repository;
  /**
  * sets the model that this controller will access
  * this should be the quantified name of the model
  * i.e. \\model\name\space\className
  **/
  public function setModel($model){
    $this->model = $model;
  }
  // public function setEntityManager(EntityManager $em){
  //   $this->entityManager = $em;
  // }
  public function setRepository(iRepository $repository){
    $this->repository = $repository;
  }
}
?>
