<?php

namespace App\Controller;

use App\Repository\DonateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/donateur', name: 'app_home')]
    public function index(DonateurRepository $donateurRepository): Response
    {
        $donateurs= $donateurRepository->findAll();

        return $this->render('home/index.html.twig', [
            'donateur_list' => $donateurs,
        ]);
    }
}
