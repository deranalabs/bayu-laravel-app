<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware; // Laravel ≥9

class TrustProxies extends Middleware
{
    /**
     * Semua proxy (Railway, Cloudflare, dll).
     *
     * @var array|string|null
     */
    protected $proxies = '*';

    /**
     * Gunakan header X-Forwarded-Proto supaya Laravel tahu request aslinya HTTPS.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_PROTO;
}