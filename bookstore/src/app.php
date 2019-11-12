<?php

$loader = require __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Annotations\AnnotationRegistry;


AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$cache = new FilesystemCache(__DIR__ . '/../var/cache');

$app = new Application([
    'cache' => function () use ($cache) {
        return $cache;
    },
]);

//skeleton
//$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});


//my
/*$app->register(new DoctrineServiceProvider());
$app->register(new DoctrineOrmServiceProvider());

$app['db.options'] = array(
    'driver'    => 'pdo_pgsql',
    'host'      => 'postgres',
    'dbname'    => 'bookstore',
    'user'      => 'root',
    'password'  => 'password',
    'charset'   => 'utf8',
);

$app['orm.proxies_dir'] = __DIR__.'/../cache/doctrine/proxies';
$app['orm.default_cache'] = 'array';
$app['orm.em.options'] = array(
    'mappings' => array(
        array(
            'type' => 'annotation',
            'path' => __DIR__.'/../../src/Entities',
            'namespace' => 'Entities',
        ),
    ),
);*/


return $app;
