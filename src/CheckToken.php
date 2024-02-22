<?php

namespace Developertugrul\EntegraApi\Middleware;

use Closure;
use Developertugrul\EntegraApi\Token;
use Developertugrul\EntegraApi\EntegraApi;

class CheckToken
{
    public function handle($request, Closure $next)
    {
        $api = new EntegraApi();

        $token = Token::find(1);

        if ($token && $token->isExpired()) {
            $api->refreshToken();
        }

        return $next($request);
    }
}
