<?php

namespace App\PoC;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product\UpdateOrCreateProduct;
use Traversable;

class ProductWithMediaProvider implements CommandProviderInterface
{
    /**
     * @return Traversable|CommandInterface[]
     */
    public function getCommands(): Traversable
    {
        $mediaFolder = realpath(__DIR__) . '/media/';

        $product = new UpdateOrCreateProduct('test-product-with-media');
        $product
            //->setFamily('clothing')
            ->addImageValue('variation_image', $mediaFolder . 'tshirt.png')
            ->addFileValue('notice', $mediaFolder . 'dummy.pdf');

        yield $product;
    }
}
