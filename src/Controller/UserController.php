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
     * @Route("/user", name="create_user", methods={"POST"})
     */
    public function addUser(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);
        $user->setRole($_POST['role']);

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Saved new user with id '.$user->getId());
    }

    /**
     *
     * @Route("/connexion", name="get_user_by_username", methods={"POST"})
     */
    public function authenticateUser(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $user = $repository->findOneBy(['username' => $_POST['username']]);

        if($user->getPassword() == $_POST['password']){
          var_dump($user);
          return new Response();
        }

    }

}
