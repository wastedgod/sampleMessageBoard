<?php
namespace sampleMessageBoard\application;
spl_autoload_register(function($class_name){
  static $basepath;
  $basepath = isset($basepath) ? $basepath : rtrim(substr(__DIR__, 0, 0 - strlen(__NAMESPACE__)), '/\\');
  $file_path = $basepath . DIRECTORY_SEPARATOR . $class_name . '.php';
  if(file_exists($file_path)){
    require_once($file_path);
  }
});
?>
