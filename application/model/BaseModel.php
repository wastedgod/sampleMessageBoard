<?php
namespace sampleMessageBoard\application\model;
use Doctrine\ORM\Mapping as ORM;

abstract class BaseModel implements iModel{
  ##############################################################################
  # listeners
  # note - use the classes under the listener directory for 99% of the cases
  ##############################################################################
  // some event listeners for create / update to set the created / modified fields
  /**
  * @ORM\PrePersist
  * sets the created and modified date time to now on record create
  **/
  public function setCreateDates(){
    $t = date_create(date('Y-m-d H:i:s'));
    $this->created = $t;
    $this->modified = $t;
  }
  /**
  * @ORM\PreUpdate
  * sets the modified date time to now on update
  **/
  public function setUpdateDates(){
    $this->modified = date_create(date("Y-m-d H:i:s"));
  }
}
?>
