<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product\ProductCommandBuilder;
use Aa\AkeneoImport\ImportCommand\ProductModel\ProductModelCommandBuilder;


class ProductAndModelProvider implements CommandProviderInterface
{
    /**
     * @return CommandInterface[]
     */
    public function getCommands(): iterable
    {
        for ($i = 0; $i < 100; $i++) {

            $modelCode = sprintf('test-product-model-%s', $i);

            $model = new ProductModelCommandBuilder($modelCode);
            $model
                ->setFamilyVariant('clothing_size')
                ->addValue('name', sprintf('Product model %d', $i))
                ->addValue('color', 'green')
            ;

            yield from $model->getCommands();

            $axes = ['s', 'm', 'l', 'xl', 'xxl'];

            foreach ($axes as $axis) {

                $identifier = sprintf('test-product-%d-%s', $i, $axis);

                $product = new ProductCommandBuilder($identifier);

                $product
                    ->setFamily('clothing')
                    ->setParent($modelCode)
                    ->setEnabled(true)
                    ->addValue('size', $axis)
                ;

                yield from $product->getCommands();
            }
        }
    }
}
