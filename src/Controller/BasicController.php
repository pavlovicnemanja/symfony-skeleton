<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class BasicController extends AbstractController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getOne($class, $id)
    {
        $view = $this->getDoctrine()
            ->getRepository($class)
            ->find($id);

        return $view;
    }

    public function getAll($class)
    {
        $view = $this->getDoctrine()
            ->getRepository($class)
            ->findAll();

        return $view;
    }

    public function handleView($data): Response
    {
        $group = is_array($data) ? 'list_view' : 'single_view';

        $serialize = $this->serializer->serialize($data, 'json', ['groups' => $group]);
    
        return new Response(
            $serialize,
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
        );
    }
}
