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
        $company_return = [];
        foreach ($companies as $company) {
            array_push($company_return, $company->getArrayCopy());
        }

        return new JsonModel($company_return);
    }

    public function get($id)
    {
        $service = $this->getCompanyService();
        $company = $service->getCompany($id);
        return new JsonModel($company->getArrayCopy());
    }

    public function create($data)
    {

    }

    public function update($id, $data)
    {

    }

    public function delete($id)
    {

    }

    public function getResponseWithHeader()
    {

    }

    private function getCompanyService()
    {
        if (!$this->companyService) {
            $this->companyService = $this->getServiceLocator()->get('company-service');
        }

        return $this->companyService;
    }
}
