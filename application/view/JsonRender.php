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
    // echo 'model = <pre>' . print_r($this->data['model']) . '</pre>' . PHP_EOL;
    // exit;
    // if(is_array($this->data['model'])){
    //   return json_encode($this->data['model']);
    // }else{
    //   $final = array();
    //   while($m = $this->data['model']->next()){
    //     echo 'm = <pre>' . print_r($m, true) . '</pre>';
    //     exit;
    //     $final[] = $m->toArray();
    //   }
    //   return json_encode($final);
    // }
    foreach((array)$this->data['model'] as $item){
      if(is_array($item)){
        $final[] = $item;
      } else {
        $final[] = $item->toArray();
      }
    }
    return json_encode($final);
  }
  private function renderItem(){
    //echo __METHOD__ . ' :: data = <pre>' . print_r($this->data, true) . '</pre>' . PHP_EOL;
    $data = $this->data['model'];
    $data = is_array($data) ? $data : $data->toArray();
    return json_encode($data);
    $data = is_array($this->data) ? $this->data : $this->data->toArray();
    return json_encode($data);
  }
}
?>
