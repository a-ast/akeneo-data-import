<?php

namespace App\Command;

use Aa\AkeneoImport\Queue\RemoteQueueFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PublishCommand extends Command
{

    /**
     * @var \Aa\AkeneoImport\Queue\RemoteQueueFactory
     */
    private $queueFactory;

    /**
     * @var \Aa\AkeneoImport\ImportCommand\CommandProviderInterface[]
     */
    private $providers;

    public function __construct(RemoteQueueFactory $queueFactory, array $providers)
    {
        parent::__construct();

        $this->queueFactory = $queueFactory;
        $this->providers = $providers;
    }

    protected function configure()
    {
        $this
            ->setName('aa:akeneo-import:publish')
            ->setDescription('Publish pim data to a queue')
            ->addArgument('provider-alias', InputArgument::REQUIRED, 'Alias of a command data provider.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $provider = $this->providers[$input->getArgument('provider-alias')];

        $queue = $this->queueFactory->create('messages');

        foreach ($provider->getCommands() as $command) {
            $queue->enqueue($command);
        }
    }
}
