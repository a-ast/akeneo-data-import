<?php

namespace App\Command;

use Aa\AkeneoImport\Import\Importer;
use Aa\AkeneoImport\ImportCommands\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommands\Exception\CommandHandlerException;
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
     * @var \Aa\AkeneoImport\ImportCommands\CommandListHandlerInterface[]
     */
    private $handlers;

    /**
     * @var \Aa\AkeneoImport\ImportCommands\CommandProviderInterface
     */
    private $provider;

    public function __construct(Importer $importer,
        CommandProviderInterface $provider,
        array $handlers
    ) {
        parent::__construct();

        $this->importer = $importer;
        $this->provider = $provider;
        $this->handlers = $handlers;
    }

    protected function configure()
    {
        $this
            ->setName('aa:akeneo-import:import')
            ->setDescription('Import pim data using given provider and import handler.')
            ->addArgument('handler-alias', InputArgument::REQUIRED, 'Alias of a command list handler.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $handler = $this->handlers[$input->getArgument('handler-alias')];

        try {
            $this->importer->import($this->provider, $handler);
        } catch (CommandHandlerException $e) {

            $style = new SymfonyStyle($input, $output);

            $style->error($e->getMessage());
            foreach ($e->getErrors() as $field => $error) {
                $style->error(sprintf('%s: %s', $field, $error));
            }

        }
    }
}
