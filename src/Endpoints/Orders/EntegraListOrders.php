<?php

namespace Developertugrul\EntegraApi\Endpoints\Orders;

use Developertugrul\EntegraApi\Token;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class EntegraListOrders
{
    private $client;
    private $token;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->token = Token::find(1);
    }


    /**
     * Get all products from the Entegra API with pagination support.
     * @return array
     * @throws Exception|GuzzleException
     */
    public function getAll(): array
    {
        $page = 1;
        $allProducts = [];

        while (true) {
            if ($this->token === null || $this->token->access === null) {
                throw new Exception('Token is not valid');
            }

            $response = $this->client->get('/order/page=' . $page . '/', [
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
     * Get the list of orders, you can also get a single order by passing the id as a parameter to this method.
     * @param int|null $id
     * @return array
     * @throws Exception|GuzzleException
     */
    public function get(int $id = null): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        if ($id === null) {
            $response = $this->client->get('/order/page=1/', [
                'headers' => [
                    'Authorization' => 'JWT ' . $this->token->access
                ]
            ]);
        } else {
            $response = $this->client->get('/order/page=1/?id=' . $id, [
                'headers' => [
                    "Authorization" => "JWT " . $this->token->access
                ]
            ]);
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get the list of orders of a supplier.
     * @param string $supplier
     * @return array
     * @throws GuzzleException
     */
    public function getSupplierOrders(string $supplier): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }
        $response = $this->client->get('/order/page=1/?supplier=' . $supplier, [
            'headers' => [
                "Authorization" => "JWT " . $this->token->access,
                "Content-Type" => "application/json"
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get the list of orders of a supplier.
     * @param string $start
     * @param string $end
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function getOrderWithDataRange(string $start, string $end): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }
        $response = $this->client->get('/order/page=1/?start_date=' . $start . '&end_date=' . $end, [
            'headers' => [
                "Authorization" => "JWT " . $this->token->access,
                "Content-Type" => "application/json"
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}