<?php
namespace sampleMessageBoard\application\view;
use Slim\View;
class JsonRender extends View{
  public function render($template){
    $f = 'render' . ucfirst($template);
    if(method_exists($this, $f)){
      return $this->$f();
    }
  }
  private function renderIndex(){
    $final = array();
    foreach((array)$this->data as $item){
      if(is_array($item)){
        $final[] = $item;
      } else {
        $final[] = $item->toArray();
      }
    }
    return json_encode($final);
  }
  private function renderItem(){
    $data = is_array($this->data) ? $this->data : $this->data->toArray();
    return json_encode($data);
  }
}
?>
