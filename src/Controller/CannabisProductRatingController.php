<?php

namespace App\Controller;

use App\Entity\CannabisProduct;
use App\Entity\CannabisProductRating;
use App\Form\CannabisProductRatingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/create/{productId}', name: '.create')]
    public function create(
        int $productId,
        Request $request,
    ): Response {

        $product = $this->entityManager->getRepository(CannabisProduct::class)->find($productId);

        $productRating = new CannabisProductRating();

        $form = $this->createForm(CannabisProductRatingType::class, $productRating);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRating = $form->getData();

            $product->addRating($productRating);

            $this->entityManager->persist($productRating);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_cannabis_product_rating.index', ['productId' => $productId]);
        }
        return $this->render('cannabis_product_rating/create.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }

    private function processRating(array $ratings) : array
    {
        $array = [];

        foreach ($ratings as $key => $rating) {
            $array[$key]['Qualität'] = $rating->getQuality();
            $array[$key]['Effekt'] = $rating->getEffect();
            $array[$key]['Sicherheit'] = $rating->getSafety();
            $array[$key]['Zuverlässigkeit'] = $rating->getReliability();
            $array[$key]['Preis Leistung'] = $rating->getPricePerformance();
            $array[$key]['Vertrauen'] = $rating->getTrust();
        }

        return $array;
    }
}
