<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    protected $proxies = '*';

    protected function getHeaders(Request $request): int
    {
        return Request::HEADER_X_FORWARDED_ALL;
    }
}