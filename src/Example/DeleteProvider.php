<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product\Delete;


class DeleteProvider implements CommandProviderInterface
{
    /**
     * @return CommandInterface[]
     */
    public function getCommands(): iterable
    {
        for ($i = 1; $i <= 1000; $i++) {

            $identifier = sprintf('test-%d', $i);

            yield new Delete($identifier);
        }
    }
}
