<?php
namespace sampleMessageBoard\application\repository;
use DoctrineExtensions\NestedSet\Manager;
use DoctrineExtensions\NestedSet\Config;
use Doctrine\ORM\EntityRepository;

class PostRepository extends BaseRepository{
  public function getPostThread($id){
    return $this->createQueryBuilder('p')
      ->select(array('p', 'c'))
      ->join('\\sampleMessageBoard\\application\\model\\BoardModel', 'c', 'WITH', 'p.lft <= c.lft AND p.rgt >= c.rgt')
      ->where('p.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getResults(\Doctrine\ORM\Query::HYDRATE_ARRAY);

    $nsm = new Manager(new Config($this->getEntityManager(), $this->_entityName));
    $model = $nsm->wrapNode($this->find($id));
    //$children =  $model->getChildren();
    $children = $model->$model->getDescendants();
    foreach($children as $c){
      $ret[] = $c->getNode()->toArray();
    }
    return $ret;



    $ret = array();
    $model = $this->getEntityManager()->find($id);
    $descendants = $model->getDescendants();
    foreach($descendants as $d){
      $ret[] = $d->toArray();
    }
    return $ret;
    //
    // $q = Doctrine_Query::create()
    //   ->select('p.*')
    //   ->from('Posts p')
    //   ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);
    // $treeObject = Doctrine_Core::getTable('Posts')->getTree();
    // $treeObject->setBaseQuery($q);
    // $tree = $treeobject->fetchTree();
    // $treeObject->restBaseQuery();
    // return $tree;
  }
  /**
  * gets the root level posts in a specific board
  *
  * @param - board_id - int - id of the board to get direct posts
  *
  * @return array - list of posts for board
  **/
  public function getBoardPosts($board_id){
    $qb = $this->createQueryBuilder('u');
    $qb->where('u.board_id = :board_id')
      ->setParameter('board_id', $board_id)
      ->andWhere('u.parent_id IS NULL');
    return $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
  }
}
?>
