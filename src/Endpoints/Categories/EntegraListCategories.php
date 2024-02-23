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
     * Get the list of products, you can also get a single product by passing the id as a parameter to this method.
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
