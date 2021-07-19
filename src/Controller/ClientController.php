<?php

namespace App\Controller;

use App\Entity\User;
use App\Controller\BasicController;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends BasicController
{
    /**
     * @Route("/client/{id}")
     */
    public function getUserAction($id)
    {
        return $this->handleView(
            $this->getOne(User::class, $id)
        );
    }
}
