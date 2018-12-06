<?php

namespace App\Command;

use Aa\Akeneo\Entities\Model\PimEntityCollection;
use Aa\Akeneo\Entities\Model\Product;
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
            ->setName('poc:product:test-publish')
            ->setDescription('Generate and publish products to RabbitMQ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $product = new Product('clothing', 'test-12345', null, false);

        $product->addValue('size', 's');
        $product->addValue('color', 'red');

        $collection = new PimEntityCollection();
        $collection->add($product);
        $collection->add($product);

        $envelope = new Envelope($collection);

        // NOT ONE BY ONE, BUT 100
        $this->bus->dispatch($envelope->with(new SentStamp(Product::class)));
    }
}
