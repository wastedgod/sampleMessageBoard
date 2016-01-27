<?php
/**
* this converts the db settings in the bootstrp file for doctrine into the
* settings array needed for phinx
**/
$container = include_once __DIR__ . '/../bootstrap.php';
$db_settings = $container->get('DbSettings');
$drivar_mapping = array(
  'pdo_mysql' => 'mysql',
);

return array(
     "paths" => array(
         "migrations" => "migrations/versions"
     ),
     "environments" => array(
         "default_migration_table" => "phinxlog",
         "default_database" => "dev",
         "dev" => array(
           'adapter' => $drivar_mapping[$db_settings['driver']],
           'host' => $db_settings['host'],
           'name' => $db_settings['dbname'],
           'user' => $db_settings['user'],
           'pass' => $db_settings['password'],
           'port' => $db_settings['port'],
         )
     )
 );

//return array($container->get('DbSettings'));
?>
