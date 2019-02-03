<?php

namespace App\Command;

use Aa\AkeneoImport\Queue\QueueFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PublishCommand extends Command
{

    /**
     * @var QueueFactory
     */
    private $queueFactory;

    /**
     * @var \Aa\AkeneoImport\ImportCommand\CommandProviderInterface[]
     */
    private $providers;

    /**
     * @var string
     */
    private $dsn;

    public function __construct(string $dsn, QueueFactory $queueFactory, array $providers)
    {
        parent::__construct();

        $this->dsn = $dsn;
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

        $queue = $this->queueFactory->createByDsn($this->dsn, 'messages');

        foreach ($provider->getCommands() as $command) {
            $queue->enqueue($command);
        }
    }
}
