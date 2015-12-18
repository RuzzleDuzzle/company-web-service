<?php
return [
    'controllers' => [
        'invokables' => [
            'User\Controller\Crud' => 'User\Controller\CrudController',
        ],
    ],
    'router' => [
        'routes' => [
            'user' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/user',
                    'defaults' => [
                        'controller' => 'User\Controller\Crud',
                        'action' => 'list',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/list',
                            'defaults' => [
                                'controller' => 'User\Controller\Crud',
                                'action' => 'list',
                            ],
                        ],
                    ],
                    'view' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/view[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'User\Controller\Crud',
                                'action' => 'view',
                                'id' => 0,
                            ],
                        ],
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'User\Controller\Crud',
                                'action' => 'add',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/edit[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'User\Controller\Crud',
                                'action' => 'edit',
                                'id' => 0,
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'User\Controller\Crud',
                                'action' => 'delete',
                                'id' => 0,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'User' => __DIR__.'/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'User_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/User/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'User\Entity' => 'User_driver',
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            'Crud' => [
                'pages' => [
                    'user' => [
                        'label' => 'User',
                        'route' => 'user/list',
                        'pages' => [
                            'list' => [
                                'label' => 'List',
                                'route' => 'user/list',
                            ],
                            'view' => [
                                'label' => 'View',
                                'route' => 'user/view',
                            ],
                            'add' => [
                                'label' => 'Add',
                                'route' => 'user/add',
                            ],
                            'edit' => [
                                'label' => 'Edit',
                                'route' => 'user/edit',
                            ],
                            'delete' => [
                                'label' => 'Delete',
                                'route' => 'user/delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]
];
