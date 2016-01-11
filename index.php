<?php
namespace sampleMessageBoard;

// get the dependency container
$container = include __DIR__ .'/bootstrap.php';

// get the slim app out of the dependency container
$app = $container->get('App');

// set up slim routes
$app->get('/post/board/:board_id', function($board_id) use( $app, $container){
  $controller = $container->get('PostController');
  $app->render('index', $controller->index($board_id));
});
$app->get('/post/thread/:thread_id', function($thread_id) use( $app, $container ){
  $controller = $container->get('PostController');
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
  $app->render('index', $controller->get($id));
});
// get list of boards
$app->get('/board', function() use( $app, $container ){
  $controller = $container->get('BoardController');
  $app->render('index', $controller->index());
});
$app->put('/board/:id', function($id) use($app, $container ){
  $controller = $container->get('BoardController');
  $params = json_decode($app->request->getBody());
  $app->render('item', $controller->update($id, $params));
});
$app->post('/board', function() use( $app, $container ){
  $controller = $container->get('BoardController');
  $params = json_decode($app->request->getBody());
  $app->render('item', $controller->create($params));
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
