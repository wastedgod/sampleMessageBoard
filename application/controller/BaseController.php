<?php
namespace sampleMessageBoard\application\controller;
use Doctrine\ORM\EntityManager;
abstract class BaseController implements iController{
  protected $model;
  /**
  * sets the model that this controller will access
  * this should be the quantified name of the model
  * i.e. \\model\name\space\className
  **/
  public function setModel($model){
    $this->model = $model;
  }
  public function setEntityManager(EntityManager $em){
    $this->entityManager = $em;
  }
}
?>
