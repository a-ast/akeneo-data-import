<?php

namespace App\PoC;

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
        for ($i = 1; $i <= 20; $i++) {

            $identifier = sprintf('test-%d', $i);
            $product = new UpdateOrCreateProduct($identifier);
            $product
                ->setFamily('clothing')
                ->setEnabled(true)
                ->setCategories(['master_men_pants_shorts'])
                ->addValue('name', 'Product '. $identifier)
                ->addValue('color', 'blue')
            ;

            yield $product;
        }
    }
}
