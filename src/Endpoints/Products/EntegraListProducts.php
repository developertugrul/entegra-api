<?php

namespace Developertugrul\EntegraApi\Endpoints\Products;

use Exception;
use GuzzleHttp\Client;
use Developertugrul\EntegraApi\Token;
use Developertugrul\EntegraApi\EntegraApi;
use GuzzleHttp\Exception\GuzzleException;

class EntegraListProducts
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
            $response = $this->client->get('/product/page=1/', [
                'headers' => [
                    'Authorization' => 'JWT ' . $this->token->access
                ]
            ]);
        } else {
            $response = $this->client->get('/product/page=1/' . $id . '/', [
                'headers' => [
                    "Authorization" => "JWT " . $this->token->access
                ]
            ]);
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get Products With Parameter(api_sync)
     * Data array should be like this:
     * [
     * "api_sync" => 1, // api_sync ile ürün listelemesi. integer
     * "productCode" => "1234567890",  productCode ile ürün listelemesi. Burada gönderilen değer içerinden özel karakter varsa bu değer 'hexa' dönüştürüp gönderilmelidir. string
     * "barcode" => "1234567890", // barcode ile ürün listelemesi. integer
     * "sync" => 1, // sync ile ürün listelemesi. integer
     * "send_api" => 1, // send_api ile ürün listelemesi. integer
     * "start_date" => "2021-01-01", // start_date ile ürün listelemesi. date
     * "end_date" => "2021-01-01", // end_date ile ürün listelemesi. date
     * "date_change" => "2021-01-01", // date_change ile ürün listelemesi. date
     * "additional_categories" => "1234567890", // additional_categories ile ürün listelemesi. string
     * "send_supplier" => "1234567890", // send_supplier ile ürün listelemesi. string
     * "id" => "1234567890", // id ile ürün listelemesi. integer
     * ]
     * @param array $data
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function getWithParameter(array $data = []): array
    {
        if ($this->token === null || $this->token->access === null) {
            throw new Exception('Token is not valid');
        }

        $response = $this->client->get('/product/page=2/?' . http_build_query($data), [
            'headers' => [
                'Authorization' => 'JWT ' . $this->token->access,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
