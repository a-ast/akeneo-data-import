<?php

namespace App\PoC;

use Aa\AkeneoImport\ImportCommands\CommandInterface;
use Aa\AkeneoImport\ImportCommands\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommands\Product\UpdateProduct;
use Aa\AkeneoImport\ImportCommands\ProductModel\UpdateProductModel;
use Traversable;

class TestProvider implements CommandProviderInterface
{
    /**
     * @return Traversable|CommandInterface[]
     */
    public function getCommands(): Traversable
    {
//        for ($i = 1; $i <= 20; $i++) {
//
//            $identifier = sprintf('test-%d', $i);
//            $product = new UpdateProduct($identifier);
//
//            $product
//                ->setFamily('clothing')
//                ->setEnabled(false)
//                ->addValue('name', 'Product '. $identifier)
//                ->addValue('color', null)
//                ->setCategories(['master_men_pants_shorts'])
//            ;
//
//            yield $product;
//        }

        for ($i = 0; $i < 100; $i++) {

            $modelCode = sprintf('product-model-%s', $i);

            $model = new UpdateProductModel($modelCode, 'clothing_size');
            $model->addValue('name', sprintf('Product model %d', $i));

            yield $model;

            $axes = ['s', 'm', 'l', 'xl', 'xxl'];

            foreach ($axes as $axis) {

                $identifier = sprintf('product-%s-%s', $modelCode, $axis);

                $product = new UpdateProduct($identifier);

                $product
                    ->setFamily('clothing')
                    ->setParent($modelCode)
                    ->addValue('size', $axis);

                yield $product;
            }
        }
    }
}
