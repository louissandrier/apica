<?php

namespace App\Controller;

use App\Entity\Personnage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PersonnageController extends AbstractController
{
    /**
     *
     * @Route("/personnage", name="create_personnage", methods={"POST"})
     */
    public function addCitation(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $personnage = new Personnage();
        $personnage->setNom($_POST['nom']);

        $entityManager->persist($personnage);
        $entityManager->flush();

        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', 'https://localhost');
        $response->setContent('Saved new film with id '.$personnage->getId());
        return $response;
    }

    /**
     *
     * @Route("/all_personnage", name="get_personnage", methods={"GET"})
     */
    public function getPersonnage(SerializerInterface $serializer): Response
    {
        $repositoryPersonnage = $this->getDoctrine()->getRepository(Personnage::class);

        $film = $repositoryPersonnage->findAll();

        return new Response(
          $serializer->serialize($film, 'json'), 200, ['Content-Type'=>'application/json', 'Access-Control-Allow-Origin'=>'https://localhost']
        );
    }

    /**
     *
     * @Route("/update_personnage/{id}", name="update_personnage", methods={"POST"})
     */
    public function updatePersonnage($id): Response
    {
      $entityManager = $this->getDoctrine()->getManager();
      $personnage = $entityManager->getRepository(Personnage::class)->find($id);

      $personnage->setNom($_POST['nom']);

      $entityManager->flush();

      $response = new Response();
      $response->headers->set('Access-Control-Allow-Origin', 'https://localhost');
      $response->setContent('Saved new personnage with id '.$personnage->getId());
      return $response;
    }

    /**
     *
     * @Route("/delete_personnage/{id}", name="delete_personnage", methods={"DELETE"})
     */
    public function deletePersonnage($id): Response
    {
      $entityManager = $this->getDoctrine()->getManager();
      $personnage = $entityManager->getRepository(Personnage::class)->find($id);

      $entityManager->remove($personnage);
      $entityManager->flush();

      $response = new Response();
      $response->headers->set('Access-Control-Allow-Origin', 'https://localhost');
      $response->setContent('Personnage supprimé');
      return $response;
    }
}
