<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Media\CreateProductMediaFile;
use Aa\AkeneoImport\ImportCommand\Media\CreateProductModelMediaFile;
use Aa\AkeneoImport\ImportCommand\Product\UpdateOrCreateProduct;
use Aa\AkeneoImport\ImportCommand\ProductModel\ProductModelCommandBuilder;
use Aa\AkeneoImport\ImportCommand\ProductModel\UpdateOrCreateProductModel;


class ProductWithMediaProvider implements CommandProviderInterface
{
    /**
     * @return CommandInterface[]
     */
    public function getCommands(): iterable
    {
        $mediaFolder = realpath(__DIR__) . '/media/';

        yield new CreateProductMediaFile('zzz', $mediaFolder . 'tshirt.png', 'variation_image');

        return;

        $builder = new ProductModelCommandBuilder('test-builder-MODEL-with-media');
        $builder
            //->setFamily('clothing')
            ->setFamilyVariant('clothing_size')
            ->addImageValue('variation_image', $mediaFolder . 'tshirt.png')
//            ->addFileValue('notice', $mediaFolder . 'dummy.pdf')
        ;

        yield from $builder->getCommands();
    }
}
