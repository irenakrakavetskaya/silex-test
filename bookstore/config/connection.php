<?php

use Silex\Provider\DoctrineServiceProvider;
use Kurl\Silex\Provider\DoctrineMigrationsProvider;

$app['db'] = $app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_pgsql',
        'host'      => 'postgres',
        'dbname'    => 'bookstore',
        'user'      => 'root',
        'password'  => 'password',
        'charset'   => 'utf8',
    ),
));

//$console = new \Symfony\Component\Console\Application();

$app->register(
    new DoctrineMigrationsProvider(),//$console
    array(
        'migrations.name' => 'Doctrine Migrations',
        'migrations.directory' => __DIR__ . '/../src/Migrations',
        'migrations.namespace' => 'Acme\Migrations',
    )
);

//$app->boot();
//$console->run();