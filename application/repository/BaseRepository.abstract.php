<?php
namespace sampleMessageBoard\application\repository;
use Doctrine\ORM\EntityRepository;
abstract class BaseRepository extends EntityRepository implements iRepository{
  public function create(iModel $model){
    $this->getEntityManager()->persist($model);
    $this->getEntityManager()->flush();
  }
  public function remove(iModel $model){
    $this->getEntityManager()->remove($model);
    $this->getEntityManager()->flush();
  }
  public function update(iModel $model){
    $this->getEntityManager()->persist($model);
    $this->getEntityManager()->flush();
  }
}
?>
