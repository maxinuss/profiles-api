<?php
declare(strict_types=1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;

use ProfilesApi\Application\ErrorHandler;
use ProfilesApi\Domain\Model\Profile\ProfileRepository;
use ProfilesApi\Infrastructure\Service\JsonTransformer;
use ProfilesApi\Infrastructure\Domain\Model\Profile\DoctrineMysqlProfileRepository;

$container = [];
$container['settings'] = [
    'httpVersion' => '1.1',
    'displayErrorDetails' => getenv('ENVIRONMENT') != 'production',
    'environment' => getenv('ENVIRONMENT') ?: 'development',
    'outputBuffering' => 'append',
    'responseChunkSize' => 4096,
    'addContentLengthHeader' => false,
    'determineRouteBeforeAppMiddleware' => true,
    'cachePath' => getenv('CACHE_PATH'),
    'logger' => [
        'name' => 'profile-app',
        'path' => getenv('LOGS_PATH'). '/app.log',
        'level' => \Monolog\Logger::DEBUG,
    ],
    'doctrine' => [
        'driver' => getenv('DB_DRIVER'),
        'host' => getenv('DB_HOST'),
        'user' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'dbname' => getenv('DB_NAME'),
    ]
];

$container['errorHandler'] = function ($c) {
    return new ErrorHandler($c->get('logger'), $c->get('settings')['displayErrorDetails']);
};
$container['phpErrorHandler'] = function ($c) {
    return $c->get('errorHandler');
};
$container['notFoundHandler'] = function ($c) {
    return [$c->get('errorHandler'), 'handleNotFound'];
};
$container['notAllowedHandler'] = function ($c) {
    return [$c->get('errorHandler'), 'handleNotAllowed'];
};

$container[JsonTransformer::class] = function ($c) {
    $manager = new Manager();
    $manager->setSerializer(new DataArraySerializer());
    return new JsonTransformer($manager);
};

$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Logger($settings['name']);
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container[EntityManagerInterface::class] = function ($c) {
    $settings = $c->get('settings');

    $configuration = Setup::createYAMLMetadataConfiguration(
        [__DIR__ . '/Infrastructure/Persistence/Doctrine/Mapping/Mysql'],
        $settings['environment'] == 'development'
    );
    $configuration->setProxyDir($settings['cachePath'] . '/Proxies');
    return EntityManager::create($settings['doctrine'], $configuration);
};

$container[ProfileRepository::class] = function ($c) {
    return new DoctrineMysqlProfileRepository($c->get(EntityManagerInterface::class));
};

return $container;
