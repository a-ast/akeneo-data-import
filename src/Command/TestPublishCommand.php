<?php

namespace App\Command;

use Aa\Akeneo\Entities\Model\PimEntityCollection;
use Aa\Akeneo\Entities\Model\Product;
use App\MyMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\SentStamp;
use Symfony\Component\Messenger\Transport\Sender\SendersLocatorInterface;

class TestPublishCommand extends Command
{

    /**
     * @var MessageBusInterface
     */
    private $bus;

    /**
     * @var \Symfony\Component\Messenger\Transport\Sender\SendersLocatorInterface
     */
    private $sendersLocator;

    public function __construct(MessageBusInterface $bus, SendersLocatorInterface $sendersLocator)
    {
        $this->bus = $bus;
        $this->sendersLocator = $sendersLocator;

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


        $envelope = new Envelope(new MyMessage());

        foreach ($this->sendersLocator->getSenders($envelope) as $sender) {
            printf('%s'.PHP_EOL, get_class($sender));
        }

        return;

        $product = new Product('test-12345');

        $product->addValue('issued', new \DateTimeImmutable());

        $collection = new PimEntityCollection();
        $collection->add($product);
        $collection->add($product);

        $envelope = new Envelope($collection);
        // NOT ONE BY ONE, BUT 100
        //$this->bus->dispatch($envelope->with(new SentStamp(Product::class)));
    }
}
