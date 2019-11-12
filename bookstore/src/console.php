<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Helper\QuestionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\EntityManager;
use Kurl\Silex\Provider\DoctrineMigrationsProvider;
use Doctrine\DBAL\Tools\Console\ConsoleRunner as DoctrineDBAL;
use Doctrine\ORM\Tools\Console\ConsoleRunner as DoctrineORM;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Symfony\Component\Console\Helper\HelperSet;

/*$console = new Application('My Silex Application', 'n/a');
$console->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
$console->setDispatcher($app['dispatcher']);
$console
    ->register('my-command')
    ->setDefinition(array(
        // new InputOption('some-option', null, InputOption::VALUE_NONE, 'Some help'),
    ))
    ->setDescription('My command description')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
        // do something
    })
;*/

//TEST
$app = require __DIR__.'/../src/app.php';

$console = new Application('REST API', '0.1.0');
$console->setDispatcher($app['dispatcher']);

$app->register(
    new DoctrineMigrationsProvider($console),
    [
        'migrations.directory' => __DIR__.'/../src/App/Migrations',
        'migrations.namespace' => 'App\Migrations',
    ]
);

$app
    ->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver'    => 'pdo_pgsql',
        'host'      => 'postgres',
        'dbname'    => 'bookstore',
        'user'      => 'root',
        'password'  => 'password',
        'charset'   => 'utf8',
    ],
])
    ->register(new DoctrineOrmServiceProvider(), [
        'orm.cache.instances.default.query' => $app['cache'],
        'orm.cache.instances.default.result' => $app['cache'],
        'orm.cache.instances.default.metadata' => $app['cache'],
        'orm.cache.instances.default.hydration' => $app['cache'],
        'orm.proxies_dir' => $app['cache']->getDirectory() . '/proxy',
        'orm.auto_generate_proxies' => false,
        'orm.em.options' => [
            'mappings' => [
                [
                    'type' => 'annotation',
                    'namespace' => 'Entity',
                    'path' => __DIR__ . '/Entity',
                    'use_simple_annotation_reader' => false,
                ],
            ],
        ],
    ]);



$app->boot();

$helperSet = $console->getHelperSet();
$helperSet->set($helperSet->get('connection'), 'db');

DoctrineDBAL::addCommands($console);
DoctrineORM::addCommands($console);

//$console->run();



//Migrations commands MY CORRECT
/*$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand());
$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand());
$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand());
$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand());
$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand());
$console->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand());*/



//require __DIR__.'/vendor/autoload.php';
//require __DIR__.'/path/to/app/config.php';

/*
$newDefaultAnnotationDrivers = array(
    __DIR__."/src",
);
$config = new \Doctrine\ORM\Configuration();
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ApcCache);
$driverImpl = $config->newDefaultAnnotationDriver($newDefaultAnnotationDrivers);
$config->setMetadataDriverImpl($driverImpl);
$config->setProxyDir($app['orm.proxies_dir']);
$config->setProxyNamespace('Proxies');
$em = EntityManager::create($app['db.options'], $config);
$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new ConnectionHelper($em->getConnection()),
    'em' => new EntityManagerHelper($em),
));
$console->setHelperSet($helpers);

/*$helperSet = new \Symfony\Component\Console\Helper\HelperSet([
    //'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($app['db']),
    'dialog' => new QuestionHelper(),
    'em' => new EntityManagerHelper($app['orm.em'])//db.
]);
$console->setHelperSet($helperSet);*/
/*
$console->addCommands([
    // DBAL Commands
    new \Doctrine\DBAL\Tools\Console\Command\RunSqlCommand(),
    new \Doctrine\DBAL\Tools\Console\Command\ImportCommand(),
    // ORM Commands
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand(),
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand(),
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand(),
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand(),
    new \Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand(),
    new \Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand(),
    new \Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand(),
    new \Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand(),
    new \Doctrine\ORM\Tools\Console\Command\RunDqlCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand(),
]);*/

//end
return $console;
