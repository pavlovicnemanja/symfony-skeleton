<?php

namespace App\Controller;

use App\Entity\User;
use App\Controller\BasicController;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends BasicController
{
    /**
     * Get logged in user
     * @Route("/user")
     */
    public function getUserAction()
    {
        return $this->handleView(
            $this->getUser()
        );
    }

    /**
     * Register new user
     * @Route("/user/register", methods={"POST"})
     */
    public function postUserAction(Request $request, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->submit($request->toArray());

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->hashPassword($user, $form->get('plainPassword')->getData())
            );

            $em->persist($user);
            $em->flush();

            return $this->handleView($user);
        }

        return new JsonResponse($form->getErrors(), Response::HTTP_BAD_REQUEST);
    }

    /**
     * Send token for forgot password functionality
     * @Route("/user/forgotPassword", methods={"PATCH"})
     *
     * @return Response
     */
    public function patchForgotPasswordAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['email' => $request->request->get('email')]);

        if (empty($user)) {
            return $this->handleView(Response::HTTP_OK);
        }

        $token = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');

        $user->setToken($token);
        $user->setTokenExpiresAt(new \DateTime('+1 hour'));

        $em->flush();

        // TODO: Implement notification service
        // $notification->forgotPassword($user, $token);

        return $this->handleView(Response::HTTP_OK);
    }
}
