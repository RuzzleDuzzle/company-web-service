<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Company\Controller\CompanyClientController' => 'Company\Controller\CompanyClientController',
            'Company\Controller\CompanyRestController' => 'Company\Controller\CompanyRestController',
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
);
