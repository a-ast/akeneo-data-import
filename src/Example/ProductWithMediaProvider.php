<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product\UpdateOrCreateProduct;
use Aa\AkeneoImport\ImportCommand\ProductModel\UpdateOrCreateProductModel;


class ProductWithMediaProvider implements CommandProviderInterface
{
    /**
     * @return CommandInterface[]
     */
    public function getCommands(): iterable
    {
        $mediaFolder = realpath(__DIR__) . '/media/';

        $product = new UpdateOrCreateProductModel('test-product-MODEL-with-media');
        $product
            //->setFamily('clothing')
            ->setFamilyVariant('clothing_size')
            ->addImageValue('variation_image', $mediaFolder . 'tshirt.png')
//            ->addFileValue('notice', $mediaFolder . 'dummy.pdf')
        ;

        yield $product;
    }
}
