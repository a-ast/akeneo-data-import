<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product;
use Aa\AkeneoImport\ImportCommand\ProductModel;
use Aa\AkeneoImport\ImportCommand\ProductModel\UpdateOrCreateProductModel;


class TwoLevelModelProvider implements CommandProviderInterface
{
    /**
     * @return CommandInterface[]
     */
    public function getCommands(): iterable
    {
        return [
            new ProductModel\SetFamilyVariant('model-0', 'clothing_color_size'),

            new ProductModel\SetFamilyVariant('model-1', 'clothing_color_size'),
            new ProductModel\SetParent('model-1', 'model-0'),
            new ProductModel\SetValues('model-1', [
                    'color' => [[
                        'data' => 'red',
                        'locale' => null,
                        'scope' => null,
                    ]]
                ]
            ),

            new Product\SetParent('sku-0', 'model-1'),
            new Product\SetValues('sku-0', [
                    'size' => [[
                        'data' => 's',
                        'locale' => null,
                        'scope' => null,
                    ]]
                ]
            ),

        ];
    }


}
