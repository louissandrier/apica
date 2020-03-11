<?php

namespace App\Controller;

use App\Entity\Citation;
use App\Entity\Personnage;
use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function getCitation(): Response
    {
        $repositoryCitation = $this->getDoctrine()->getRepository(Citation::class);

        $citation = $repositoryCitation->findAll();

        var_dump($citation->getId());
        die();

        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', 'https://localhost');
        $response->setContent(json_encode([$citation,]));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
