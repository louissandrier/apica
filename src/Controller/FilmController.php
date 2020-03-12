<?php

namespace App\Controller;

use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

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

        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', 'https://localhost');
        $response->setContent('Saved new film with id '.$film->getId());
        return $response;
    }

    /**
     *
     * @Route("/all_film", name="get_all_film", methods={"GET"})
     */
    public function getFilm(SerializerInterface $serializer): Response
    {
        $repositoryFilm = $this->getDoctrine()->getRepository(Film::class);

        $film = $repositoryFilm->findAll();

        return new Response(
          $serializer->serialize($film, 'json'), 200, ['Content-Type'=>'application/json', 'Access-Control-Allow-Origin'=>'https://localhost']
        );
    }

    /**
     *
     * @Route("/update_film/{id}", name="update_film", methods={"POST"})
     */
    public function updateFilm($id): Response
    {
      $entityManager = $this->getDoctrine()->getManager();
      $film = $entityManager->getRepository(Film::class)->find($id);

      $film->setTitre($_POST['titre']);

      $entityManager->flush();

      $response = new Response();
      $response->headers->set('Access-Control-Allow-Origin', 'https://localhost');
      $response->setContent('Saved new film with id '.$film->getId());
      return $response;
    }

    /**
     *
     * @Route("/delete_film/{id}", name="delete_film", methods={"DELETE"})
     */
    public function deleteFilm($id): Response
    {
      $entityManager = $this->getDoctrine()->getManager();
      $film = $entityManager->getRepository(Film::class)->find($id);

      $entityManager->remove($film);
      $entityManager->flush();

      $response = new Response();
      $response->headers->set('Access-Control-Allow-Origin', 'https://localhost');
      $response->setContent('Film supprimé');
      return $response;
    }
}
