<?php

namespace App\Command;

use Aa\AkeneoImport\CommandBus\Consumer;
use Aa\AkeneoImport\Import\Importer;
use Aa\AkeneoImport\ImportCommands\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommands\Exception\CommandHandlerException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class ConsumeCommand extends Command
{

    /**
     * @var \Aa\AkeneoImport\CommandBus\Consumer
     */
    private $consumer;

    /**
     * @var array
     */
    private $availableHandlers;

    public function __construct(Consumer $consumer, array $availableHandlers)
    {
        parent::__construct();

        $this->consumer = $consumer;
        $this->availableHandlers = $availableHandlers;
    }

    protected function configure()
    {
        $this
            ->setName('aa:akeneo-import:consume')
            ->setDescription('Consume pim data from the queue')
            ->addArgument('handler-alias', InputArgument::REQUIRED, 'Alias of a command list handler.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $handler = $this->availableHandlers[$input->getArgument('handler-alias')];

        $this->consumer->consume($handler);
    }
}
