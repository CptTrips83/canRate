<?php

namespace App\Controller;

use App\Entity\CannabisProduct;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cannabis/product', name: 'app_cannabis_product')]
class CannabisProductController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/', name: '.index', methods: ['GET'])]
    public function index(): Response
    {
        $products = $this->entityManager->getRepository(CannabisProduct::class)->findAll();

        return $this->render('cannabis_product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
