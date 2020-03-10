<?php

namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     *
     * @Route("/user", name="create_user")
     */
    public function createUser(): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setUsername('Adminn');
        $user->setPassword('super-admin');
        $user->setRole('1');

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Saved new user with id '.$user->getId());
    }

}