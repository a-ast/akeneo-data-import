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
        yield new Delete('bla-1');
        yield new Delete('bla-2');

        //        for ($i = 1; $i <= 10; $i++) {
//
//            $identifier = sprintf('test-%d', $i);
//
//            yield new Delete($identifier);
//        }
    }
}
