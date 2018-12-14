<?php

namespace App\PoC;

use Aa\AkeneoImport\ImportCommands\CommandInterface;
use Aa\AkeneoImport\ImportCommands\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommands\Product\UpdateProduct;
use Traversable;

class TestProvider implements CommandProviderInterface
{
    /**
     * @return Traversable|CommandInterface[]
     */
    public function getCommands(): Traversable
    {
        for ($i = 1; $i <= 20; $i++) {

            $identifier = sprintf('test-%d', $i);
            $product = new UpdateProduct($identifier);

            $product
                ->setFamily('clothing')
                ->setEnabled(false)
//                ->addValue('name', 'Product '. $identifier)
//                ->addValue('color', 'red')
            ;

            yield $product;
        }
    }
}
