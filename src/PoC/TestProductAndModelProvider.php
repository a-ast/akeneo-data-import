<?php

namespace App\PoC;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product\UpdateOrCreateProduct;
use Aa\AkeneoImport\ImportCommand\ProductModel\UpdateOrCreateProductModel;
use Traversable;

class TestProductAndModelProvider implements CommandProviderInterface
{
    /**
     * @return Traversable|CommandInterface[]
     */
    public function getCommands(): Traversable
    {
        for ($i = 0; $i < 3; $i++) {

            $modelCode = sprintf('product-model-%s', $i);

            $model = new UpdateOrCreateProductModel($modelCode);
            $model
                ->setFamilyVariant('clothing_size')
                ->addValue('name', sprintf('Product model %d', $i))
                ->addValue('color', 'green')
            ;

            yield $model;

            $axes = ['s', 'm', 'l', 'xl', 'xxl'];

            foreach ($axes as $axis) {

                $identifier = sprintf('product-%s-%s', $modelCode, $axis);

                $product = new UpdateOrCreateProduct($identifier);

                $product
                    ->setFamily('clothing')
                    ->setParent($modelCode)
                    ->setEnabled(true)
                    ->addValue('size', $axis)
                ;

                yield $product;
            }
        }
    }
}
