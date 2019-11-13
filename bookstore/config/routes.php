<?php
// config/routes.php

use App\Controller\BookController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Psr\Log\LoggerInterface;

/*return function (RoutingConfigurator $routes, LoggerInterface $logger) {
    $logger->error('An error occurred');
    $routes->add( 'api_read_book', '/api/books/{id}')
        ->controller([BookController::class, 'read'])
        ->methods(['GET']);

};*/


$app->get('/api/books/{id}', 'App\Controller\BookController::read');