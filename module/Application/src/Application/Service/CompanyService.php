<?php

namespace Application\Service;

use Application\Entity\Company;
use Doctrine\ORM\EntityManager;

class CompanyService
{
    protected $em;

    public function setEm(EntityManager $em)
    {
        $this->em = $em;
        return $this;
    }

    public function fetchAll()
    {
        $companyRepository = $this->em->getRepository('Application\Entity\Company');
        $companyList = $companyRepository->findAll();
        return $companyList;
    }

    public function getCompany($id)
    {
        //TODO: Will need some checks whether entity was found or not.
        $company = $this->em->find('Application\Entity\Company', $id);
        if (!$company) {
            return \Exception(sprintf('Company with id %d was not found', $id));
        }

        return $company;
    }

    public function createCompany(array $data)
    {
        if (empty($data)) {
            return \Exception('data array cannot be empty');
        }

        //TODO: remember about dependencies and set Country! Exchange array might not work in this case.
        $company = new Company($data);
        $this->em->persist($company);
        $this->em->flush();
        return $company;
    }

    public function updateCompany($id = 0, $data)
    {
        if (empty($id) || empty($data)) {
            return \Exception('Data array and entity id are required.');
        }

        $company = $this->getCompany($id);
        $company->exchangeArray($data);
        $this->em->flush();
        return $company;
    }

    public function deleteCompany($id)
    {
        if (empty($id)) {
            return \Exception('Entity id is required.');
        }

        $company = $this->getCompany($id);
        $this->em->remove($company);
        $this->em->flush();
    }

    public function getCountryList()
    {
        $countryRep = $this->em->getRepository('Application\Entity\Country');
        $countries = $countryRep->findAll();
        return $countries;
    }
}
