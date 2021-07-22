<?php

namespace App\Controller;

use App\Entity\Company;
use App\Controller\BasicController;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends BasicController
{
    /**
     * @Route("/companies")
     */
    public function getCompaniesAction()
    {
        return $this->handleView(
            $this->getAll(Company::class)
        );
    }

    /**
     * @Route("/company/{id}")
     */
    public function getCompanyAction($id)
    {
        return $this->handleView(
            $this->getOne(Company::class, $id)
        );
    }
}
