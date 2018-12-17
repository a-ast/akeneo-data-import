<?php

namespace App\Command;

use Aa\AkeneoImport\Import\Importer;
use Aa\AkeneoImport\ImportCommands\CommandListHandlerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ImportCommand extends Command
{
    /**
     * @var Importer
     */
    private $importer;

    /**
     * @var \Aa\AkeneoImport\ImportCommands\CommandListHandlerInterface
     */
    private $handler;

    public function __construct(Importer $importer, CommandListHandlerInterface $handler)
    {
        parent::__construct();

        $this->importer = $importer;
        $this->handler = $handler;
    }

    protected function configure()
    {
        $this
            ->setName('aa:akeneo-import:import')
            ->setDescription('Import products');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->importer->import($this->handler);
    }
}
