<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\AjoutProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/produits', name: 'app_produits')]
    public function new(Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(AjoutProduitType::class, $produit, ['attr' => ["class" => "test"]]);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $produit = $form->getData();

            $this->entityManager->persist($produit);
            $this->entityManager->flush();
            return $this->redirect($request->getUri());
        }

        return $this->render(
            "produits/index.html.twig",
            ['formProduit' => $form->createView()]
        );
    }
}
