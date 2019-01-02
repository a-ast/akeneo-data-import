<?php

namespace App\Command;

use Aa\AkeneoImport\CommandBus\Consumer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsumeCommand extends Command
{
    /**
     * @var Consumer
     */
    private $consumer;

    /**
     * @var array
     */
    private $availableHandlers;

    /**
     * @var array
     */
    private $availableCommandClasses;

    public function __construct(Consumer $consumer, array $availableHandlers, array $availableCommandClasses)
    {
        parent::__construct();

        $this->consumer = $consumer;
        $this->availableHandlers = $availableHandlers;
        $this->availableCommandClasses = $availableCommandClasses;
    }

    protected function configure()
    {
        $this
            ->setName('aa:akeneo-import:consume')
            ->setDescription('Consume pim data from the queue')
            ->addArgument('handler-alias', InputArgument::REQUIRED, 'Alias of a command list handler.')
            ->addArgument('command-class-alias', InputArgument::REQUIRED, 'Alias of a command class.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $handler = $this->availableHandlers[$input->getArgument('handler-alias')];
        $queueName = $this->availableCommandClasses[$input->getArgument('command-class-alias')];

        $this->consumer->consume($handler, $queueName);
    }
}
