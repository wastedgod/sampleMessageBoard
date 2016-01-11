<?php
namespace sampleMessageBoard;
use sampleMessageBoard\application\controller\PostController;
use sampleMessageBoard\application\controller\BoardController;
use sampleMessageBoard\application\controller\UserController;
use sampleMessageBoard\application\model\PostModel;
use sampleMessageBoard\application\model\BoardModel;
use sampleMessageBoard\application\model\UserModel;
use sampleMessageBoard\application\view\JsonRender;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use DI\object;
use DI\get;
use DI\ContainerBuilder;
use Interop\Container\ContainerInterface;
use Slim\Slim;

// start composer autoloader
include __DIR__ . '/vendor/autoload.php';

// start application autoloader
include __DIR__ . '/application/autoload.php';

/**
* set up the PHP-DI container item.
**/
$builder = new ContainerBuilder();
$builder->addDefinitions([
  ##############################################################################
  # config values
  ##############################################################################
  // oauth settings
  'OAuthCredentials' => array(
    'google' => array(
      'key' => '',
      'secret' => '',
      'requestAccess' => array('userinfo_email', 'userinfo_profile'),
      'requestPath' => 'userinfo',
    ),
    'amazon' => array(
      'key' => '',
      'secret' => '',
      'requestAccess' => array('profile'),
      'requestPath' => '/user/profile',
    ),
    'facebook' => array(
      'key' => '',
      'secret' => '',
      'requestAccess' => array(),
      'requestPath' => '/me'
    )
  ),
  // settings for configuring slim
  'AppSettings' => function(ContainerInterface $c){
    return array(
      'mode' => getenv('APP_MODE') == null ? 'dev' : getenv('APP_MODE'),
      'view' => $c->get('TemplateEngine'),
    );
  },
  // database conneciton information. currently set up to pull from apache enviroment variables
  'DbSettings' => function(ContainerInterface $c){
    return array(
      'host' => getenv('DB_HOST'),
      'dbname' => getenv('DB_NAME'),
      'user' => getenv('DB_USERNAME'),
      'password' => getenv('DB_PASSWORD'),
      'driver' => getenv('DB_DRIVER')
    );
  },
  // paths to the directories containg app components
  'ControllerPath' => __DIR__ . '/controller',
  'ModelPath' => __DIR__ . '/model',
  'RepositoryPath' => __DIR__ . '/repository',
  'ListenerPath' => __DIR__ . '/listener',
  'NestedSetLibPath' => __DIR__ . '/vendor/doctrine2-nestedset-master/lib',
  // set up doctrines database access layer
  'DbalSettings' => function(ContainerInterface $c){
    //set up doctrines database access layer settings
    $paths = array( $c->get('ModelPath'), $c->get('RepositoryPath'));
    $mode = getenv('APP_MODE') == null ? 'dev' : getenv('APP_MODE');
    $dbal_config = Setup::createAnnotationMetadataConfiguration($paths, $mode == 'dev' ? true : false);

    // need to tell doctrine where to load models and repositories.  I can't think of a better place to put this so puting it here
    (new \Doctrine\Common\ClassLoader(__NAMESPACE__ . '\\model', $c->get('ModelPath')))
      ->register();
    (new \Doctrine\Common\ClassLoader(__NAMESPACE__ . '\\repository', $c->get('RepositoryPath')))
      ->register();
    (new \Doctrine\Common\ClassLoader('DoctrineExtensions\\NestedSet', $c->get('NestedSetLibPath')))
      ->register();
    return $dbal_config;
  },
  ##############################################################################
  # library items
  ##############################################################################
  // create the slim appliction
  'App' => function(ContainerInterface $c){
    return new Slim($c->get('AppSettings'));
  },
  // create the template engine that slim should use to render content
  'TemplateEngine' => \DI\object(JsonRender::class),
  // create the doctirne entity manager
  'EntityManager' => function(ContainerInterface $c){
    return EntityManager::create(
      \Doctrine\DBAL\DriverManager::getConnection($c->get('DbSettings'), $c->get('DbalSettings')),
      $c->get('DbalSettings')
    );
  },
  ##############################################################################
  # controllers
  ##############################################################################
  'PostController' => \DI\object(PostController::class)
    ->method('setModel', \DI\get('PostModel'))
    ->method('setEntityManager', \DI\get('EntityManager')),
  'BoardController' => \DI\object(BoardController::class)
    ->method('setModel', \DI\get('BoardModel'))
    ->method('setEntityManager', \DI\get('EntityManager')),
  'AuthController' => \DI\object(AuthController::class)
    ->method('setSiteCredentials', \DI\get('OAuthCredentials'))
    ->method('setEntityManager', \DI\get('EntityManager')),
  'UserController' => \DI\object(UserController::class)
    ->method('setModel', \DI\object('UserModel'))
    ->method('setAuthController', \DI\get('AuthController'))
    ->method('setEntityManager', \DI\get('EntityManager')),
  ##############################################################################
  # Model
  ##############################################################################
  'PostModel' => PostModel::class,
  'BoardModel' => BoardModel::class,
  'UserModel' => UserModel::class,
]);
return $builder->build();
?>
