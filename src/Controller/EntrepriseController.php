<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// Utiliser plutot Repository que EntityManagerInterface: EntityManagerInterface permettra autre chose.
class EntrepriseController extends AbstractController
{
    #[Route('/entreprise', name: 'app_entreprise')]
    // public function index(EntityManagerInterface $entityManager): Response
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {
        // $entreprises = $entityManager->getRepository(Entreprise::class)->findAll();
        // $entreprises = $entrepriseRepository->findAll();

        // SELECT * FROM entreprise ORDER BY raisonSociale

        // SELECT * FROM entreprise WHERE ville = 'Strasbourg' ORDER BY raisonSociale ASC
        // $entreprises = $entrepriseRepository->findBy(["ville" => "Strasbourg"], ["raisonSociale" => "ASC"]);


        $entreprises = $entrepriseRepository->findBy([], ["raisonSociale" => "ASC"]);
        return $this->render('entreprise/index.html.twig', [
            'entreprises' => $entreprises,
        ]);
    }

    // Dans entreprise la clé primaire est id. va permettre de nous faire travailler le params converter ( permet faire le lien avec l'objet qu'on souhaite ) 

    // params converter: outil sym , calsse symfony , récupère par déduction 



    #[Route('/entreprise/new', name: 'new_entreprise')]
    #[Route('/entreprise/{id}/edit', name: 'edit_entreprise')]
    public function new_edit(Entreprise $entreprise = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$entreprise) {
            $entreprise = new Entreprise();
        }

        $form = $this->createForm(EntrepriseType::class, $entreprise);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
 
            $entreprise = $form->getData();
            // prepare PDO
            $entityManager->persist($entreprise);
            // execute PDO
            $entityManager->flush();

            return $this->redirectToRoute('app_entreprise');
        }

        //  bloc soumssion

        return $this->render('entreprise/new.html.twig', [
            'formAddEntreprise' => $form,
            'edit' => $entreprise->getId()
        ]);

        // affiche formulaire d'ajout

        // 'edit' => $entreprise->getId() : si édit = vrai(true) éditer une entreprise, sinon ajouter une entreprise (pour titre h1)
    }

    // on crée une nouvelle entreprise
    // crée formulaire entreprise type
    // si formulaire souis et valide
    // on récupere donnée formulaire
    // prepare object qui est pret à etre inseré en bas de donnée
    //  flush : execute
    //  on redirect

    #[Route('/entreprise/{id}/delete', name: 'delete_entreprise')]
    public function delete_entreprise(Entreprise $entreprise, EntityManagerInterface $entityManager){

        $entityManager->remove($entreprise);
        $entityManager->flush();

        return $this->redirectToRoute('app_entreprise');

    }

    #[Route('/entreprise/{id}', name: 'show_entreprise')]
    public function show(Entreprise $entreprise): Response
    {
        return $this->render('entreprise/show.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }
}


