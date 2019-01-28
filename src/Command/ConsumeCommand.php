<?php

namespace App\Command;

use Aa\AkeneoImport\Import\ImporterInterface;
use Aa\AkeneoImport\Queue\RemoteQueueFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsumeCommand extends Command
{
    /**
     * @var \Aa\AkeneoImport\Queue\RemoteQueueFactory
     */
    private $queueFactory;

    /**
     * @var \Aa\AkeneoImport\Import\ImporterInterface
     */
    private $importer;

    public function __construct(RemoteQueueFactory $queueFactory, ImporterInterface $importer)
    {
        parent::__construct();

        $this->queueFactory = $queueFactory;
        $this->importer = $importer;
    }

    protected function configure()
    {
        $this
            ->setName('aa:akeneo-import:consume')
            ->setDescription('Consume pim data from the queue')
            ->addArgument('queue-name', InputArgument::REQUIRED, 'Queue name.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $queueName = $input->getArgument('queue-name');
        $queue = $this->queueFactory->create($queueName);

        $this->importer->importQueue($queue);
    }
}
