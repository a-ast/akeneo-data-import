<?php

namespace App\Command;

use Aa\AkeneoImport\Import\ImporterInterface;
use Aa\AkeneoImport\Queue\QueueFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsumeCommand extends Command
{
    /**
     * @var QueueFactory
     */
    private $queueFactory;

    /**
     * @var ImporterInterface
     */
    private $importer;

    /**
     * @var string
     */
    private $dsn;

    public function __construct(string $dsn, QueueFactory $queueFactory, ImporterInterface $importer)
    {
        parent::__construct();

        $this->dsn = $dsn;
        $this->queueFactory = $queueFactory;
        $this->importer = $importer;
    }

    protected function configure()
    {
        $this
            ->setName('akeneo-import:consume')
            ->setDescription('Consume pim data from the queue')
            ->addArgument('queue-name', InputArgument::REQUIRED, 'Queue name.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $queueName = $input->getArgument('queue-name');
        $queue = $this->queueFactory->createByDsn($this->dsn, $queueName);

        $this->importer->importQueue($queue);
    }
}
