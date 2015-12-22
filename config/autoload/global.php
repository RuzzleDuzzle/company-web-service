<?php

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
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'dbname' => 'company_web_service',
                    'charset' => 'UTF8',
                    'driverOptions' => array(
                        'charset' => 'UTF8'
                    )
                )
            ),
        ),
        'fixture' => array(
            __DIR__ . '/../../data/DoctrineORMModule/Fixtures',
        ),
    ),
);
