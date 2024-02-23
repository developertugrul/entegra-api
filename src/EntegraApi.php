<?php

namespace Developertugrul\EntegraApi;

use GuzzleHttp\Client;
use Developertugrul\EntegraApi\Token;
use Illuminate\Support\Facades\Schema;
use Developertugrul\EntegraApi\Endpoints\Products\EntegraListProducts;
use Developertugrul\EntegraApi\Endpoints\Categories\EntegraListCategories;

class EntegraApi
{
    private $client;
    private $products;
    private $categories;

    public function __construct()
    {
        $this->checkMigration();
        $this->client = new Client(['base_uri' => 'https://apiv2.entegrabilisim.com']);
        $this->products = new EntegraListProducts($this->client);
        $this->categories = new EntegraListCategories($this->client);
        $this->obtainToken();
    }

    private function checkMigration()
    {
        if (!Schema::hasTable('tokens')) {
            throw new \Exception('Migration has not been run. Please run the migration first.');
        }
    }

    public function obtainToken()
    {
        $token = Token::find(1);

        if (is_null($token) || $token->isExpired()) {
            $response = $this->client->request('POST', '/api/user/token/obtain/', [
                'json' => [
                    'email' => getenv('ENTEGRA_API_USERNAME'),
                    'password' => getenv('ENTEGRA_API_PASSWORD')
                ],
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['refresh'], $data['access'], $data['expire_at'])) {
                $this->storeToken($data['access'], $data['expire_at'], $data['refresh']);
            } else {
                throw new \Exception('Token data is not valid');
            }
        }
    }

    private function storeToken($accessToken, $expiresAt, $refresh)
    {
        $token = Token::firstOrCreate(['id' => 1]);
        $token->access = $accessToken;
        $token->expire_at = $expiresAt;
        $token->refresh = $refresh;
        $token->save();
    }

    public function refreshToken()
    {
        $token = Token::find(1);

        if ($token) {
            $response = $this->client->request('POST', '/api/user/token/refresh/', [
                'json' => [
                    'refresh' => $token->refresh
                ],
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['access'], $data['expire_at'])) {
                $this->storeToken($data['access'], $data['expire_at'], $token->refresh);
            } else {
                throw new \Exception('Token data is not valid');
            }
        } else {
            throw new \Exception('No token found to refresh');
        }
    }

    public function products()
    {
        return $this->products;
    }

    public function categories()
    {
        return $this->categories;
    }
}
