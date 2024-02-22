<?php

namespace Developertugrul\EntegraApi\Endpoints\Products;

use GuzzleHttp\Client;
use Developertugrul\EntegraApi\Token;

class EntegraListProducts
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get()
    {
        $response = $this->client->get('/api/products', [
            'headers' => [
                'Authorization' => 'Bearer ' . Token::find(1)->token
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
