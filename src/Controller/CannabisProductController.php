<?php

namespace App\Controller;

use App\Entity\CannabisProduct;
use App\Entity\CannabisProductRating;
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

        $processedProducts = $this->processRating($products);

        return $this->render('cannabis_product/index.html.twig', [
            'products' => $processedProducts,
        ]);
    }

    private function processRating(array $products) : array
    {
        $array = [];

        /**
         * @var int $key
         * @var CannabisProduct $product
         */
        foreach ($products as $key => $product) {
            $array[$key]['id'] = $product->getId();
            $array[$key]['name'] = $product->getName();
            $array[$key]['producer'] = $product->getProducer();
            $array[$key]['imageUrl'] = $product->getImageUrl();
            $array[$key]['thcContent'] = $product->getThcContent();
            $array[$key]['cbdContent'] = $product->getCbdContent();

            $avgRating = $this->getAvgRatingForProduct($product);
            $countRating = $this->getCountRatingForProduct($product);
            $array[$key]['avgRating'] = $avgRating;
            $array[$key]['countRating'] = $countRating;
        }

        return $array;
    }

    private function getAvgRatingForProduct(CannabisProduct $product) : int
    {
        $sum = 0;
        $count = 0;

        $productRatings = $this->entityManager->getRepository(CannabisProductRating::class)->findBy([
            'product' => $product,
        ]);

        foreach ($productRatings as $productRating) {
            $sum += $productRating->getQuality();
            $sum += $productRating->getEffect();
            $sum += $productRating->getSafety();
            $sum += $productRating->getReliability();
            $sum += $productRating->getPricePerformance();
            $sum += $productRating->getTrust();
            $count += 6;
        }

        return $count == 0 ? 0 : ceil($sum / $count);
    }

    private function getCountRatingForProduct(CannabisProduct $product) : int
    {
        $productRatings = $this->entityManager->getRepository(CannabisProductRating::class)->findBy([
            'product' => $product,
        ]);

        return count($productRatings);
    }
}
