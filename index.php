<?php
  require 'vendor/autoload.php';
  
  use Symfony\Component\HttpFoundation\Response;

  //const app = express();
  $app = new Silex\Application();
  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
  ));

  $app->get('/', function () use($app) {
    return $app['twig']->render('home.twig', array(
      'content' => 'Добро пожаловать!'
    ));  
  });

  $app->get('/add/{n1}/{n2}', function ($n1, $n2) use($app) {
    return '<h1>' . $n1 . ' + ' . $n2 . ' = ' ($n1 + $n2) . '</h1>';
  });

  $app->error(function ($e) use($app) {
    if ($e instanceof Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
      return new Response($app['twig']->render('404.twig'), 404);
    } else {
      return new Response($app['twig']->render('500.twig'), 500);
    };
  });

  $app->run();