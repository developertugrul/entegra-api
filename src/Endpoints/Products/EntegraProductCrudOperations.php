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

    /**
     * Add a product to the Entegra API using version 2. The data array should be like https://documenter.getpostman.com/view/23999845/2s84LKWZug#6fda9501-dba6-4d56-8347-dc619f65b40d
     * @param array $productData
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function addProductv2(array $productData): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->post( '/product/v2/', [
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

    /**
     * Add a product pictures. The data array should be like https://documenter.getpostman.com/view/23999845/2s84LKWZug#267431fd-6aff-4834-adbd-9d3e7a77b368
     * @param array $productData
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function addProductPictures(array $productData): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->post( '/product/pictures/', [
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

    /**
     * Update a product variations. The data array should be like https://documenter.getpostman.com/view/23999845/2s84LKWZug#59bd372a-3d70-43c7-b403-b93d83030775
     * @param array $productData
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function addProductVariations(array $productData): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->post( '/product/variations/', [
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

    /**
     * Update a product variations. The data array should be like https://documenter.getpostman.com/view/23999845/2s84LKWZug#59bd372a-3d70-43c7-b403-b93d83030775
     * @param array $productData
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function updateProduct(array $productData): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->put( '/product/', [
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


    /**
     * Delete a product from the Entegra API using the provided data. The data array should be like https://documenter.getpostman.com/view/23999845/2s84LKWZug#8f744c3e-bc57-4a3d-98fb-84dd38f72d63
     * @param array $productData
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function updateProductV2(array $productData): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->put( '/product/update/', [
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

    /**
     * Delete a product from the Entegra API using the provided data. The data array should be like https://documenter.getpostman.com/view/23999845/2s84LKWZug#8f744c3e-bc57-4a3d-98fb-84dd38f72d63
     * @param array $productData
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function updateVariation(array $productData): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->put( '/product/variations/', [
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

    /**
     * Delete a product from the Entegra API using the provided data. The data array should be like https://documenter.getpostman.com/view/23999845/2s84LKWZug#8f744c3e-bc57-4a3d-98fb-84dd38f72d63
     * @param array $productData
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function updateProductQuantity(array $productData): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->put( '/product/quantity/', [
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

    /**
     * Delete a product from the Entegra API using the provided data. The data array should be like https://documenter.getpostman.com/view/23999845/2s84LKWZug#8f744c3e-bc57-4a3d-98fb-84dd38f72d63
     * @param array $productData
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function updateProductPrice(array $productData): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->put( '/product/prices/', [
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

    /**
     * Delete a product from the Entegra API using the provided data. The data array should be like https://documenter.getpostman.com/view/23999845/2s84LKWZug#8f744c3e-bc57-4a3d-98fb-84dd38f72d63
     * @param array $productData
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function updateProductPriceByVariationId(array $productData): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->put( '/product/variation/prices/', [
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

    /**
     * Delete a product from the Entegra API using the provided data. The data array should be like https://documenter.getpostman.com/view/23999845/2s84LKWZug#8f744c3e-bc57-4a3d-98fb-84dd38f72d63
     * @param array $productData
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function updateProductQuantityByVariationId(array $productData): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->put( '/product/variation/quantity/', [
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