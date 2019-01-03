<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\Category\UpdateOrCreateCategory;
use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product\UpdateOrCreateProduct;
use Traversable;

class CategoryProvider implements CommandProviderInterface
{
    /**
     * @return Traversable|CommandInterface[]
     */
    public function getCommands(): Traversable
    {
        $categoryCodes = ['c1', 'c2', 'c3'];

        $locales = ['en_US', 'de_DE', 'fr_FR'];

        $parent = 'master';

        foreach ($categoryCodes as $categoryCode) {

            $category = new UpdateOrCreateCategory($categoryCode);
            foreach ($locales as $locale) {
                $category
                    ->setParent($parent)
                    ->addLabel(sprintf('%s [%s]', $categoryCode, $locale), $locale);
            }

            $parent = $categoryCode;

            yield $category;
        }
    }
}
