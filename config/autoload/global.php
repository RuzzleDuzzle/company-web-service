<?php

$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

return array(
    'service_manager' => array(
        'aliases' => array(
            'em' => 'Doctrine\ORM\EntityManager',
        ),
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'cache' => 'Zend\Cache\Service\StorageCacheFactory',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'my_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../../module/Application/src/Application/Entity',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application\Entity' => 'my_annotation_driver',
                    'Company\Entity' => 'my_annotation_driver',
                ),
            ),
        ),
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => $server,
                    'port' => 3306,
                    'user' => $username,
                    'password' => $password,
                    'dbname' => $db,
                    'charset' => 'UTF8',
                    'driverOptions' => array(
                        'charset' => 'UTF8'
                    )
                )
            ),
        ),
        'cache' => array(
            'class' => 'Doctrine\Common\Cache\ApcCache'
        ),
        'configuration' => array(
            'orm_default' => array(
                'metadata_cache' => 'apc',
                'query_cache'    => 'apc',
                'result_cache'   => 'apc',

                'generate_proxies' => false,
            )
        ),
        'fixture' => array(
            __DIR__ . '/../../data/DoctrineORMModule/Fixtures',
        ),
    ),
    'data-fixture' => array(
        __DIR__ . '/../../data/DoctrineORMModule/Fixtures',
    ),
);
