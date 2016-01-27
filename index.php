<?php
namespace sampleMessageBoard;

// get the dependency container
$container = include __DIR__ .'/bootstrap.php';

// get the slim app out of the dependency container
$app = $container->get('App');

// set up slim routes

$app->get('/login', function() use ($app, $container){
  $controller = $container->get('AuthController');
  $controller->setApp($app);
  $landingPage = 'http://' . $_SERVER['HTTP_HOST'] . '/sampleMessageBoard/login';
  $service = $controller->getAuthService(
    'google',
    $landingPage
  );
  $code = $app->request->params('code');
  $state = $app->request->params('state');
  if(empty($code) || empty($state)){
    $app->redirect($service->getAuthorizationUri());
  } else {
    $service->requestAccessToken($code, $state);
    $result = json_decode($service->request('userinfo'), true);
    echo 'results = <pre>' . print_r($result, true) . '</pre>';
  }

});
$app->get('/login2', function(){
  echo 'here';
  exit;
});

// $app->get('/post/board/:board_id', function($board_id) use( $app, $container){
//   $controller = $container->get('PostController');
//   $app->render('index', $controller->index($board_id));
// });

$app->get('/thread/:id', function($id) use( $app, $container ){
  $controller = $container->get('PostController');
  echo 'thred = <pre>' . print_r($controller->getThread($id), true) . '</pre>' . PHP_EOL;
  exit;
  $app->render('index', $controller->getThread($thread_id));
});
// update post
$app->put('/post/:id', function($id) use( $app, $container ){
  $controller = $container->get('PostController');
  $params = json_decode($app->request->getBody());
  $controller->update($id, $params);
});
// create post
$app->post('/post', function() use( $app, $container ){
  $controller = $container->get('PostController');
  $params = json_decode($app->request->getBody());
  $controller->create($params);
});
// remove post
$app->post('/delete/:id', function($id){
  $controller = $container->get('PostController');
  $controller->remove($id);
});


// get direct posts inside a board
$app->get('/board/:id', function($id) use( $app, $container ){
  $controller = $container->get('BoardController');
  $boardModel = $controller->get($id);
  $postController = $container->get('PostController');
  $posts = $postController->getBoardPosts($id);
  $boardData = $boardModel->toArray();
  $boardData['posts'] = $posts;
  $app->render('item', array('model' => $boardData));
})->conditions(array('id' => '[0-9]+'));
// get list of boards
$app->get('/board', function() use( $app, $container ){
  $controller = $container->get('BoardController');
  $app->response->headers->set('Content-Type', 'application/json');
  $app->render('index', array('model' =>$controller->index(false)));
});
$app->put('/board/:id', function($id) use($app, $container ){
  $controller = $container->get('BoardController');
  $params = json_decode($app->request->getBody());
  $app->render('item', $controller->update($id, $params));
});
$app->post('/board', function() use( $app, $container ){
  $controller = $container->get('BoardController');
  $params = json_decode($app->request->getBody());
  $model = $controller->create($params);
  if($model){
    $app->response->headers->set('Content-Type', 'application/json');
    $app->render('item', array('model' => $model));
  }

});
// $app->group('/post', function() use($app, $container){
//   echo 'here 2';
//   exit;
//   $controller = $container->get('PostController');
//   $app->get('', function(){
//     $models = $controller->index();
//     $app->render('index', $models);
//   });
//   $app->get('/:id', function($id) use($app, $container, $controller){
//     $model = $controller->get($id);
//     $app->render('item', $model);
//   });
// });

$app->run();
?>
