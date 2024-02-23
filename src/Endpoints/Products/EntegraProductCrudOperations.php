<?php

namespace Developertugrul\EntegraApi\Endpoints\Products;

use Developertugrul\EntegraApi\Token;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class EntegraProductCrudOperations
{
    private $client;
    private $token;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->token = Token::find(1);
    }


    /**
     * Add a product to the Entegra API using the provided data. The data array should be like https://documenter.getpostman.com/view/23999845/2s84LKWZug#8f744c3e-bc57-4a3d-98fb-84dd38f72d63
     * @param array $productData
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function addProduct(array $productData): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->post( '/product/', [
            'headers' => [
                'Authorization' => 'JWT ' . $this->token->access,
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                "list" => $productData
            ])
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}