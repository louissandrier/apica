<?php

namespace App\Controller;

use App\Entity\Citation;
use App\Entity\Personnage;
use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CitationController extends AbstractController
{
    /**
     *
     * @Route("/add_citation", name="create_citation", methods={"POST"})
     */
    public function addCitation(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryPersonnage = $this->getDoctrine()->getRepository(Personnage::class);
        $repositoryFilm = $this->getDoctrine()->getRepository(Film::class);

        $personnage = $repositoryPersonnage->findOneBy(['id' => $_POST['personnage']]);
        $film = $repositoryFilm->findOneBy(['id' => $_POST['film']]);

        $citation = new Citation();
        $citation->setPersonnage($personnage);
        $citation->setFilm($film);
        $citation->setCitation($_POST['citation']);

        $entityManager->persist($citation);
        $entityManager->flush();

        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', 'https://localhost');
        $response->setContent('Saved new citation with id '.$citation->getId());
        return $response;
    }

    /**
     *
     * @Route("/all_citation", name="get_citation", methods={"GET"})
     */
    public function getCitation(SerializerInterface $serializer): Response
    {
        $repositoryCitation = $this->getDoctrine()->getRepository(Citation::class);

        $film = $repositoryCitation->findAll();

        return new Response(
          $serializer->serialize($film, 'json'), 200, ['Content-Type'=>'application/json', 'Access-Control-Allow-Origin'=>'https://localhost']
        );
    }

    /**
     *
     * @Route("/citation_by_film", name="get_citation_by_film", methods={"POST"})
     */
    public function getCitationByFilm(SerializerInterface $serializer): Response
    {
        $repositoryCitation = $this->getDoctrine()->getRepository(Citation::class);

        $citation = $repositoryCitation->findBy(
            ['film' => $_POST['film']]
        );

        return new Response(
          $serializer->serialize($citation, 'json'), 200, ['Content-Type'=>'application/json', 'Access-Control-Allow-Origin'=>'https://localhost']
        );
    }

    /**
     *
     * @Route("/citation_by_personnage", name="get_citation_by_personnage", methods={"POST"})
     */
    public function getCitationByPersonnage(SerializerInterface $serializer): Response
    {
        $repositoryCitation = $this->getDoctrine()->getRepository(Citation::class);

        $citation = $repositoryCitation->findBy(
            ['personnage' => $_POST['personnage']]
        );

        return new Response(
          $serializer->serialize($citation, 'json'), 200, ['Content-Type'=>'application/json', 'Access-Control-Allow-Origin'=>'https://localhost']
        );
    }

    /**
     *
     * @Route("/update_citation/{id}", name="update_citation", methods={"POST"})
     */
    public function updateCitation($id): Response
    {
      $entityManager = $this->getDoctrine()->getManager();
      $citation = $entityManager->getRepository(Citation::class)->find($id);

      $repositoryPersonnage = $this->getDoctrine()->getRepository(Personnage::class);
      $repositoryFilm = $this->getDoctrine()->getRepository(Film::class);

      $personnage = $repositoryPersonnage->findOneBy(['id' => $_POST['personnage']]);
      $film = $repositoryFilm->findOneBy(['id' => $_POST['film']]);

      $citation->setPersonnage($personnage);
      $citation->setFilm($film);
      $citation->setCitation($_POST['citation']);

      $entityManager->flush();

      $response = new Response();
      $response->headers->set('Access-Control-Allow-Origin', 'https://localhost');
      $response->setContent('Saved new citation with id '.$citation->getId());
      return $response;
    }

    /**
     *
     * @Route("/delete_citation/{id}", name="delete_citation", methods={"DELETE"})
     */
    public function deleteCitation($id): Response
    {
      $entityManager = $this->getDoctrine()->getManager();
      $citation = $entityManager->getRepository(Citation::class)->find($id);

      $entityManager->remove($citation);
      $entityManager->flush();

      $response = new Response();
      $response->headers->set('Access-Control-Allow-Origin', 'https://localhost');
      $response->setContent('Citation supprimé');
      return $response;
    }

}
