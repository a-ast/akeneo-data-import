<?php

namespace App\Command;

use Aa\Akeneo\ImportCommands\CommandList;
use Aa\Akeneo\ImportCommands\Product\UpdateProduct;
use DateTimeImmutable;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\SentStamp;

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
        $product = new UpdateProduct('test-12345'.((string)random_int(1,1000)));

        $product->addValue('description', 'huawei', 'en_US', 'ecommerce');

        $collection = new CommandList();
        $collection->add($product);
        $collection->add($product);

        $envelope = new Envelope($collection);
        // NOT ONE BY ONE, BUT 100
        $this->bus->dispatch($envelope->with(new SentStamp(UpdateProduct::class)));
    }
}
