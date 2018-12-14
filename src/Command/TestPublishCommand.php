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
        for ($i = 1; $i <= 20; $i++) {

            $identifier = sprintf('test-%d', $i);
            $product = new UpdateProduct($identifier);

            // how to get field names? constant?
            // no types - all mixed
//
//            new UpdateProductField($identifier, 'family', 'clothing');
//            new UpdateProductField($identifier, 'enabled', true);

//            $product->setFamily('clothing');
            $product->setEnabled(true);
//            $product->addValue('name', 'Product '. $identifier);
            $product->addValue('color', 'red');

            $this->bus->dispatch($product);
        }

        $this->bus->dispatch(new FinishImport());
    }
}
