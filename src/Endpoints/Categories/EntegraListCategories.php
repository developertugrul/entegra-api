<?php

namespace Developertugrul\EntegraApi\Endpoints\Categories;

use Exception;
use GuzzleHttp\Client;
use Developertugrul\EntegraApi\Token;
use Developertugrul\EntegraApi\EntegraApi;
use GuzzleHttp\Exception\GuzzleException;

class EntegraListCategories
{
    private $client;
    private $token;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->token = Token::find(1);
    }

    /**
     * Get the list of categories, you can also get a single category by passing the id as a parameter to this method.
     * @throws GuzzleException
     * @throws Exception
     */
    public function getAll(): array
    {
        $page = 1;
        $allProducts = [];

        while (true) {
            if ($this->token === null || $this->token->access === null) {
                throw new Exception('Token is not valid');
            }

            $response = $this->client->get('/category/page=' . $page . '/', [
                'headers' => [
                    'Authorization' => 'JWT ' . $this->token->access
                ]
            ]);

            $products = json_decode($response->getBody()->getContents(), true);

            // If the response is empty, break the loop
            if (empty($products)) {
                break;
            }

            // Merge the products into the allProducts array
            $allProducts = array_merge($allProducts, $products);

            // Increment the page number
            $page++;
        }

        return $allProducts;
    }

    /**
     * Get the list of products, you can also get a single product by passing the id as a parameter to this method. It will return the first page of the products. Only 100 products will be returned.
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function get(): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->get('/category/page=1/', [
            'headers' => [
                'Authorization' => 'JWT ' . $this->token->access
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

}
