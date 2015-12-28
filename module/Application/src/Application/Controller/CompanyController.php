<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class CompanyController extends AbstractRestfulController
{
    protected $companyService;

    public function getList()
    {
        $service = $this->getCompanyService();
        $companies = $service->fetchAll();
        return new JsonModel(array('data' => $companies));
    }

    public function get($id)
    {
        $service = $this->getCompanyService();
        $company = $service->getCompany($id);
        $owner = $company->getOwner()->getArrayCopy();
        $companyArray = $company->getArrayCopy();
        $companyArray['owner'] = $owner;
        return new JsonModel(array('data' => $companyArray));
    }

    public function create($data)
    {
        $service = $this->getCompanyService();
        $company = $service->createCompany($data);
        return new JsonModel(array('data' => $company));
    }

    public function update($id, $data)
    {
        $service = $this->getCompanyService();
        $company = $service->updateCompany($id, $data);
        $owner = $company->getOwner()->getArrayCopy();
        $companyArray = $company->getArrayCopy();
        $companyArray['owner'] = $owner;
        return new JsonModel(array('data' => $companyArray));
    }

    public function delete($id)
    {
        $service = $this->getCompanyService();
        $service->deleteCompany($id);
        return new JsonModel(array('data' > 'deleted'));
    }

    private function getCompanyService()
    {
        if (!$this->companyService) {
            $this->companyService = $this->getServiceLocator()->get('company-service');
        }

        return $this->companyService;
    }
}
