<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Company\Controller\CompanyController' => 'Company\Controller\CompanyController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'company' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/company',
                    'defaults' => array(
                        'Company\Controller' => 'SanRestful\Controller',
                        'controller'    => 'SampleRestful',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'client' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/client[/:action]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'action' => 'index',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Company' => __DIR__.'/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'Company_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__.'/../src/Company/Entity',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Company\Entity' => 'Company_driver',
                ),
            ),
        ),
    ),
);
