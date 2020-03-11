<?php

namespace App\Controller;

use App\Entity\Citation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CitationController extends AbstractController
{
    /**
     *
     * @Route("/citation", name="create_citation", methods={"POST"})
     */
    public function addCitation(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $citation = new Citation();
        $citation->setPersonnage($_POST['personnage']);
        $citation->setFilm($_POST['film']);
        $citation->setCitation($_POST['citation']);

        $entityManager->persist($citation);
        $entityManager->flush();

        return new Response('Saved new citation with id '.$citation->getId());
    }
}