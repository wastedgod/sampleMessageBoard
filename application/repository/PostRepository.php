<?php
namespace sampleMessageBoard\application\repository;
use Doctrine\ORM\EntityRepository;
class PostRepository extends EntityRepository{
  public function getPostThread($id){
    $model = $this->getEntityManager()->find($id);
    return $model->getDescendants();
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
}
?>
