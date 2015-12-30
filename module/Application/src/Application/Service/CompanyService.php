<?php

namespace Application\Service;

use Application\Entity\Company;
use Application\Entity\Owner;

use Doctrine\ORM\EntityManager;use Zend\Mvc\Application;

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
        //TODO: return to normal
        $query= $this->em->createQuery('select c, o from Application\Entity\Company c left join c.owner o order by c.id');
        $results = $query->getArrayResult();
        return $results;
    }

    public function getCompany($id)
    {
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
        $em = $this->em;
        $owner = new Owner($data['owner']);
        unset($data['owner']);
        $company = new Company($data);
        $owner->setCompany($company);
        $company->setOwner($owner);
        $em->persist($company);
        $em->flush();
        return $company;
    }

    public function updateCompany($id = 0, $data)
    {
        if (empty($id) || empty($data)) {
            return \Exception('Data array and entity id are required.');
        }

        $em = $this->em;
        $company = $this->getCompany($id);
        $companyOwner = $company->getOwner();
        if ($data['owner']['name'] !== $companyOwner->getName()) {
            $companyOwner->setName($data['owner']['name']);
        }
        unset($data['owner']);
        $company->exchangeArray($data);
        $this->em->flush();
        return $company;
    }

    public function deleteCompany($id)
    {
        $company = $this->getCompany($id);
        $this->em->remove($company);
        $this->em->flush();
    }
}
