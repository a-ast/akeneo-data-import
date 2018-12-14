<?php

namespace App\Command;

use Aa\AkeneoImport\Import\Importer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ImportCommand extends Command
{
    /**
     * @var Importer
     */
    private $importer;

    public function __construct(Importer $importer)
    {
        parent::__construct();

        $this->importer = $importer;
    }

    protected function configure()
    {
        $this
            ->setName('aa:akeneo-import:import')
            ->setDescription('Import products');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->importer->import();
    }
}
