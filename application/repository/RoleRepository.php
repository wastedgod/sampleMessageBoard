<?php
namespace sampleMessageBoard\application\repository;
use DoctrineExtensions\NestedSet\Manager;
use DoctrineExtensions\NestedSet\Config;

class RoleRepository extends TreeRepository{
  public function getRoleList($id){
    return $this->createQueryBuilder('b')
      ->select(array('c.id', 'c.role'))
      ->join('\\sampleMessageBoard\\application\\model\\RoleModel', 'c', 'p.lft <= c.lft AND p.rgt >= c.rgt')
      ->where('b.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getResults(\Doctrine\ORM\Query::HYDRATE_ARRAY);
  }
}
?>
