<?php

namespace App\Command;

use Aa\AkeneoImport\ImportCommands\Control\FinishImport;
use Aa\AkeneoImport\ImportCommands\Product\UpdateProduct;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class TestPublishCommand extends Command
{
    /**
     * @var MessageBusInterface
     */
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('aa:akeneo-import:test-publish')
            ->setDescription('Generate and publish products to RabbitMQ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        for ($i = 1; $i <= 22; $i++) {

            $product = new UpdateProduct(sprintf('test-%d', $i));
            $this->bus->dispatch($product);
        }

        $this->bus->dispatch(new FinishImport());
    }
}
