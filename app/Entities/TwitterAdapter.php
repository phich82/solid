<?php

namespace App\Entities;

use App\Contracts\SocialPostContract;
use App\Contracts\SocialUpdateContract;

/**
 * Adapter Pattern
 * 
 * This class (adapter) must implement the old interface (for Facebook)
 * Next, inject interface / new class (Twitter) into constructor of this class (adapter)
 */
class TwitterAdapter implements SocialPostContract
{
    private $client;

    public function __construct(SocialUpdateContract $client)
    {
        $this->client = $client;
    }

    public function post()
    {
        $this->client->tweet();
    }
}