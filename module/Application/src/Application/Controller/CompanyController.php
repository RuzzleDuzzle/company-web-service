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

        return new JsonModel(array('data' => $company_return));
    }

    public function get($id)
    {
        $service = $this->getCompanyService();
        $company = $service->getCompany($id);
        $countries = $service->getCountryList();
        $countryList = [];
        foreach ($countries as $country) {
            array_push($countryList, $country->getArrayCopy());
        }

        return new JsonModel(array('data' => array(
            'company' => $company->getArrayCopy(),
            'countries' => $countryList
        )));
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
        return new JsonModel(array('data' => $company));
    }

    public function delete($id)
    {
        $service = $this->getCompanyService();
        $service->deleteCompany($id);
        return new JsonModel(array('data' > 'deleted'));
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
