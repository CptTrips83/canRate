<?php

namespace App\Controller;

use App\Entity\CannabisProduct;
use App\Entity\CannabisProductRating;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cannabis/product/rating', name: 'app_cannabis_product_rating')]
class CannabisProductRatingController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/{productId}', name: '.index', methods: ['GET'])]
    public function index(
        int $productId,
    ): Response {
        $product = $this->entityManager->getRepository(CannabisProduct::class)->find($productId);

        $ratings = $this->entityManager->getRepository(CannabisProductRating::class)->findBy([
            'product' => $product,
        ]);
        $processedRatings = $this->processRating($ratings);

        return $this->render('cannabis_product_rating/index.html.twig', [
            'ratings' => $processedRatings,
            'product' => $product,
        ]);
    }


    private function processRating(array $ratings) : array
    {
        $array = [];

        foreach ($ratings as $key => $rating) {
            $array[$key]['quality'] = $rating->getQuality();
            $array[$key]['effect'] = $rating->getEffect();
            $array[$key]['safety'] = $rating->getSafety();
            $array[$key]['reliability'] = $rating->getReliability();
            $array[$key]['pricePerformance'] = $rating->getPricePerformance();
        }

        return $array;
    }
}
