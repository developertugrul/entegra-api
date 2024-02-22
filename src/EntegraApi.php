<?php

namespace Developertugrul\EntegraApi;

use GuzzleHttp\Client;
use Developertugrul\EntegraApi\Token;
use Illuminate\Support\Facades\Schema;
use Developertugrul\EntegraApi\Endpoints\Products\EntegraListProducts;

class EntegraApi
{
    private $client;
    private $products;

    public function __construct()
    {
        $this->checkMigration();
        $this->client = new Client(['base_uri' => 'https://apiv2.entegrabilisim.com']);
        $this->products = new EntegraListProducts($this->client);
        $this->obtainToken();
    }

    private function checkMigration()
    {
        if (!Schema::hasTable('tokens')) {
            throw new \Exception('Migration has not been run. Please run the migration first.');
        }
    }

    private function obtainToken()
    {
        $token = Token::find(1);

        if (!$token || $token->isExpired()) {
            $response = $this->client->post('/api/user/token/obtain/', [
                'auth' => [getenv('ENTEGRA_API_USERNAME'), getenv('ENTEGRA_API_PASSWORD')]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['refresh'], $data['access'], $data['expire_at'])) {
                $this->storeToken($data['access'], $data['expire_at'], $data['refresh']);
            } else {
                throw new \Exception('Token data is not valid');
            }
        }
    }

    private function storeToken($token, $expiresAt, $refresh)
    {
        Token::updateOrCreate(
            ['id' => 1],
            ['token' => $token, 'expires_at' => $expiresAt, 'refresh' => $refresh]
        );
    }

    public function refreshToken()
    {
        $token = Token::find(1);

        if ($token) {
            $response = $this->client->post('/api/user/token/refresh/', [
                'auth' => [getenv('ENTEGRA_API_USERNAME'), getenv('ENTEGRA_API_PASSWORD')],
                'form_params' => [
                    'refresh' => $token->refresh
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['access'], $data['expire_at'])) {
                $this->storeToken($data['access'], $data['expire_at'], $data['refresh']);
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
}
