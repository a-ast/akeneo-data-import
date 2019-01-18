<?php

namespace App\Command;

use Aa\AkeneoImport\CommandHandler\Api\ApiCommandHandlerFactory;
use Aa\AkeneoImport\CommandHandler\Api\ResponseValidator\Exception\ValidationException;
use Aa\AkeneoImport\Import\Importer;
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

    /**
     * @var \Aa\AkeneoImport\ImportCommand\CommandHandlerInterface[]
     */
    private $handlers;

    /**
     * @var \Aa\AkeneoImport\CommandHandler\Api\ApiCommandHandlerFactory
     */
    private $factory;

    /**
     * @var \Akeneo\Pim\ApiClient\AkeneoPimClientInterface
     */
    private $client;

    public function __construct(Importer $importer,
        array $providers,

        AkeneoPimClientInterface $client,
        ApiCommandHandlerFactory $factory
    ) {
        parent::__construct();

        $this->importer = $importer;
        $this->providers = $providers;
        $this->factory = $factory;
        $this->client = $client;
    }

    protected function configure()
    {
        $this
            ->setName('aa:akeneo-import:import')
            ->setDescription('Import pim data using given provider and import handler.')
            ->addArgument('provider-alias', InputArgument::REQUIRED, 'Alias of a command data provider.')
//            ->addArgument('handler-alias', InputArgument::REQUIRED, 'Alias of a command list handler.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $provider = $this->providers[$input->getArgument('provider-alias')];
//        $handler = $this->handlers[$input->getArgument('handler-alias')];


        $handlers = $this->factory->createByApiClient($this->client);

        try {
            $this->importer->import($provider->getCommands(), $handlers);
        } catch (CommandHandlerException $e) {

            $style = new SymfonyStyle($input, $output);

            $style->error(sprintf('Failed by import of %s: %s', $e->getCommandClass(), $e->getMessage()));

            $previous = $e->getPrevious();
            if ($previous instanceof ValidationException) {
                foreach ($previous->getResponse()->getErrors() as $error) {
                    foreach ($error as $key => $value) {
                        $output->writeln(sprintf('%s: %s', $key, $value));
                    }
                }
            }
        }
    }
}
