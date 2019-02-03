<?php

namespace App\Command;

use Aa\AkeneoImport\CommandHandler\Api\ApiCommandHandlerFactory;
use Aa\AkeneoImport\CommandHandler\Api\ResponseValidator\Exception\ValidationException;
use Aa\AkeneoImport\Import\Importer;
use Aa\AkeneoImport\Import\ImporterInterface;
use Aa\AkeneoImport\ImportCommand\Exception\CommandHandlerException;
use Akeneo\Pim\ApiClient\AkeneoPimClient;
use Akeneo\Pim\ApiClient\AkeneoPimClientInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class ImportCommand extends Command
{
    /**
     * @var Importer
     */
    private $importer;

    /**
     * @var \Aa\AkeneoImport\ImportCommand\CommandProviderInterface[]
     */
    private $providers;

    public function __construct(ImporterInterface $importer, array $providers)
    {
        parent::__construct();

        $this->importer = $importer;
        $this->providers = $providers;
    }

    protected function configure()
    {
        $this
            ->setName('aa:akeneo-import:import')
            ->setDescription('Import pim data using given provider and import handler.')
            ->addArgument('provider-alias', InputArgument::REQUIRED, 'Alias of a command data provider.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $provider = $this->providers[$input->getArgument('provider-alias')];

        $this->importer->import($provider->getCommands());
    }
}
