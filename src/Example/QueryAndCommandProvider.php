<?php

namespace App\Example;

use Aa\AkeneoImport\ImportCommand\CommandInterface;
use Aa\AkeneoImport\ImportCommand\CommandProviderInterface;
use Aa\AkeneoImport\ImportCommand\Product;
use Akeneo\Pim\ApiClient\AkeneoPimClientInterface;
use Akeneo\Pim\ApiClient\Search\SearchBuilder;


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
     * @return CommandInterface[]
     */
    public function getCommands(): iterable
    {
        $searchBuilder = new SearchBuilder();
        $searchBuilder->addFilter('name', 'CONTAINS', 'test');

        $products = $this->client->getProductApi()->all(100, ['search' => $searchBuilder->getFilters()]);

        foreach ($products as $productData) {
            yield (new Product\SetEnabled($productData['identifier'], false));
//            yield (new Product\Delete($productData['identifier']));
        }
    }
}
