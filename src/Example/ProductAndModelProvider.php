<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product\UpdateOrCreateProduct;
use Aa\AkeneoImport\ImportCommand\ProductModel\ProductModelCommandBuilder;
use Aa\AkeneoImport\ImportCommand\ProductModel\UpdateOrCreateProductModel;


class ProductAndModelProvider implements CommandProviderInterface
{
    /**
     * @return CommandInterface[]
     */
    public function getCommands(): iterable
    {
        for ($i = 0; $i < 10; $i++) {

            $modelCode = sprintf('product-model-%s', $i);

            $model = new ProductModelCommandBuilder($modelCode);
            $model
                // ->setFamilyVariant('clothing_size')
                ->addValue('name', sprintf('Product model %d', $i))
                ->addValue('color', 'green')
            ;

            yield from $model->getCommands();

            $axes = ['s', 'm', 'l', 'xl', 'xxl'];

            foreach ($axes as $axis) {

                $identifier = sprintf('product-%s-%s', $modelCode, $axis);

//                $product = new UpdateOrCreateProduct($identifier);
//
//                $product
//                    ->setFamily('clothing')
//                    ->setParent($modelCode)
//                    ->setEnabled(true)
//                    ->addValue('size', $axis)
//                ;

                // yield $product;
            }
        }
    }
}
