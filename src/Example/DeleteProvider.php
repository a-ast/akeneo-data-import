<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product\DeleteProduct;


class DeleteProvider implements CommandProviderInterface
{
    /**
     * @return CommandInterface[]
     */
    public function getCommands(): iterable
    {
        for ($i = 1; $i <= 10; $i++) {

            $identifier = sprintf('test-%d', $i);

            yield new DeleteProduct($identifier);
        }
    }
}
