<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product\UpdateOrCreateProduct;
use Akeneo\Pim\ApiClient\AkeneoPimClientInterface;
use Akeneo\Pim\ApiClient\Search\SearchBuilder;
use Traversable;

class QueryAndCommandProvider implements CommandProviderInterface
{
    /**
     * @var AkeneoPimClientInterface
     */
    private $client;

    public function __construct(AkeneoPimClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return Traversable|CommandInterface[]
     */
    public function getCommands(): Traversable
    {
        $searchBuilder = new SearchBuilder();
        $searchBuilder->addFilter('name', 'CONTAINS', 'test');

        $products = $this->client->getProductApi()->all(100, ['search' => $searchBuilder->getFilters()]);

        foreach ($products as $productData) {
            yield (new UpdateOrCreateProduct($productData['identifier']))->setEnabled(false);
        }
    }
}
