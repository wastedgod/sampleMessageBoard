<?php
namespace sampleMessageBoard\application\repository;
use Doctrine\ORM\EntityRepository;
use sampleMessageBoard\application\model\BoardModel;
class BoardRepository extends BaseRepository{
  public function getIndexAsArray(){
    return $this->getIndex(\Doctrine\ORM\Query::HYDRATE_OBJECT);
  }
  public function getIndexAsObject(){
    return $this->getIndex(\Doctrine\ORM\Query::HYDRATE_ARRAY)
  }
  public function getIndex($mode = \Doctrine\ORM\Query::HYDRATE_OBJECT, $orderby = array('created' => 'DESC')){
    $qb = $this->createQueryBuilder('b')
      ->select('b');
    foreach($orderby as $k => $v){
      $qb->addOrderBy('b.' . $k, $v);
    }
    return $qb->getQuery()->getResult($mode);
  }
}
?>
