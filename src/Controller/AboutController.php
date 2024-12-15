<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cannabis/about', name: 'app_cannabis_about')]
class AboutController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/impressum', name: '.impressum')]
    public function impressum(): Response
    {
        return $this->render('about/impressum.html.twig', [

        ]);
    }

    #[Route('/datenschutz', name: '.datenschutz')]
    public function datenschutz(): Response
    {
        return $this->render('about/datenschutz.html.twig', [

        ]);
    }
}
