<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product\ProductCommandBuilder;


class ProductProvider implements CommandProviderInterface
{
    /**
     * @return CommandInterface[]
     */
    public function getCommands(): iterable
    {
        for ($i = 1; $i <= 100; $i++) {

            $identifier = sprintf('test-%d', $i);
            $product = new ProductCommandBuilder($identifier);
            $product
                ->setFamily('clothing')
                ->setEnabled(true)
                ->setCategories(['notebooks', 'goodies'])
                ->addValue('name', 'Product '. $identifier . '_' . $i)
                ->addValue('color', 'red')
                ->addAssociatedProducts('PACK', ['1712634', '10627329'])
            ;

            yield from $product->getCommands();
        }
    }
}
