<?php

namespace Application\Factory;

use Application\Service\CompanyService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CompanyServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new CompanyService;
        $em = $serviceLocator->get('em');
        $service->setEm($em);

        return $service;
    }
}
