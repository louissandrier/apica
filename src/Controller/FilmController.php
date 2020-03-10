<?php

namespace App\Controller;


use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class FilmController extends AbstractController
{
    /**
     *
     * @Route("/film", name="create_film", methods={"POST"})
     */
    public function addFilm(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $film = new Film();
        $film->setTitre($_POST['titre']);

        $entityManager->persist($film);
        $entityManager->flush();

        return new Response('Saved new user with id '.$film->getId());
    }

}