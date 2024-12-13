<?php

namespace App\Controller\Admin;

use App\Entity\CannabisProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\Image;

class CannabisProductCrudController extends AbstractCrudController
{
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
            TextField::new('thcContent'),
            TextField::new('cbdContent'),
            ImageField::new('imageUrl')
                ->setBasePath('/uploads/images')
                ->setUploadDir('public/assets/images')
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
}
