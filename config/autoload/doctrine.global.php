<?php

declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

return [
    'doctrine' => [
        'connection' => [
            'driver'   => 'pdo_mysql',
            'host'     => getenv('DB_HOST') ?: 'db',
            'dbname'   => getenv('DB_DATABASE') ?: 'weather_db',
            'user'     => getenv('DB_USERNAME') ?: 'user',
            'password' => getenv('DB_PASSWORD') ?: 'password',
            'charset'  => 'utf8mb4',
        ],
        'entity_paths' => [
            __DIR__ . '/../../src/App/Entity',
        ],
        'dev_mode' => false,
    ],
    'dependencies' => [
        'factories' => [
            EntityManagerInterface::class => function ($container) {
                $config = $container->get('config')['doctrine'];

                $ormConfig = ORMSetup::createAttributeMetadataConfiguration(
                    $config['entity_paths'],
                    $config['dev_mode'],
                );

                $connection = DriverManager::getConnection(
                    $config['connection'],
                    $ormConfig,
                );

                return new EntityManager($connection, $ormConfig);
            },
        ],
    ],
];
