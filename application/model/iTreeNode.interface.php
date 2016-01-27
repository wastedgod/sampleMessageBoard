<?php
namespace sampleMessageBoard\application\model;

interface iTreeNode extends iModel{
  public function getParentId();
}
?>
