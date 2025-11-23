<?php

namespace App\Controller;

use App\Entity\Donateur;
use App\Form\DonateurType;
use App\Repository\CollecteRepository;
use App\Repository\DonateurRepository;
use App\Repository\LieuRepository;
use App\Repository\StockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
final class HomeController extends AbstractController
{



   /* #[Route('/donateur', name: 'app_home')]
    public function allDonateurs(DonateurRepository $donateurRepository): Response
    {
        $donateurs= $donateurRepository->findAll();
     

        return $this->render('home/index.html.twig', [
            'donateur_list' => $donateurs,
        ]);
    }
*/
    #[Route('/collecte', name: 'app_collectes')]
    public function allCollectes(CollecteRepository $collecteRepository,StockRepository $stockRepository): Response
    {
        $collectes= $collecteRepository->findAll();
        $stock= $stockRepository->findAll();
     

        return $this->render('home/index.html.twig', [
            'collectes_list' => $collectes,
            'stock' => $stock,
        ]);
    }
   
    #[Route('/register', name:'app_new_donateur')]
    public function AddDonateur(Request $request ,
    EntityManagerInterface $entityManager,
    LieuRepository $lieuRepository, 
    UserPasswordHasherInterface $passwordHasher):Response
    {
        $donateur = new Donateur();
        $form = $this->createForm(DonateurType::class,$donateur);
        $form->handleRequest($request);
        //verfier que il est de type Poste
        if($form->isSubmitted() && $form->isValid()){
            $plainPassword = $form->get('password')->getData();
            $hashedPassword = $passwordHasher->hashPassword($donateur, $plainPassword);
            $donateur->setPassword($hashedPassword);
            $entityManager->persist($donateur);
            $entityManager->flush();
            //redirection
            return $this->redirectToRoute('app_collectes');
        }

        $lieux= $lieuRepository->findAll();
        return $this->render('home/NewDonnateur.html.twig',[
            'DonateurForm' => $form->createView(),
            'lieux' => $lieux,
        ]);

    }
 
    #[Route('/stock', name: 'app_stock')]
    public function stock(StockRepository $stockRepository): Response
    {
     
        $stock= $stockRepository->findAll();
     

        return $this->render('home/stock.html.twig', [
            'stock' => $stock,
        ]);
    }
 
   
 

   
}
