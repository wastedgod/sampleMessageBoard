<?php
namespace sampleMessageBoard\application\repository;
use DoctrineExtensions\NestedSet\Manager;
use DoctrineExtensions\NestedSet\Config;

class ProviderRepository extends BaseRepository{
  public function getIndexAsArray(){
    return $this->getEntityManager()
      ->createQueryBuilder('p')
      ->select('p')
      ->getQuery()
      ->getResults(\Doctrine\ORM\Query::HYDRATE_ARRAY);
  }
}
?>
