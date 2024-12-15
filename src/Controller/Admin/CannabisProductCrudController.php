<?php

namespace App\Controller\Admin;

use App\Entity\CannabisProducer;
use App\Entity\CannabisProduct;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\Image;

class CannabisProductCrudController extends AbstractCrudController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return CannabisProduct::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name'),
            TextField::new('type'),
            TextField::new('producer')
            ->setRequired(false)
            ->onlyOnIndex(),
            ChoiceField::new('producer')->setChoices([
                $this->getProducerChoices()
            ])
            ->hideOnIndex(),
            TextField::new('thcContent'),
            TextField::new('cbdContent'),
            ImageField::new('imageUrl')
                ->setBasePath('/uploads/images')
                ->setUploadDir('/public/images')
                ->setFileConstraints(new Image(maxSize: '900k'))
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setRequired(false)
                ->setLabel('Image (Size 268x175 Max. 900kb)')
                ->onlyOnForms(),
        ];
    }

    public function createEntity(string $entityFqcn): CannabisProduct
    {
        return new CannabisProduct();
    }

    private function getProducerChoices() : array
    {
        $producer = $this->entityManager->getRepository(CannabisProducer::class)->findAll();

        $choices = [];

        foreach ($producer as $key => $value) {
            $choices[$value->getName()] = $value;
        }

        return $choices;
    }
}
