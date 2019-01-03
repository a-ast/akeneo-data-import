<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product\UpdateOrCreateProduct;
use Traversable;

class TestProductProvider implements CommandProviderInterface
{
    /**
     * @return Traversable|CommandInterface[]
     */
    public function getCommands(): Traversable
    {
        for ($i = 1; $i <= 10; $i++) {

            $identifier = sprintf('test-%d', $i);
            $product = new UpdateOrCreateProduct($identifier);
            $product
                ->setFamily('clothing')
                ->setEnabled(true)
                ->setCategories(['notebooks', 'goodies'])
                ->addValue('name', 'Product '. $identifier . '_' . $i)
                ->addValue('color', 'red')
                ->addAssociatedProducts('PACK', ['1712634', '10627329'])
            ;

            yield $product;
        }
    }
}
