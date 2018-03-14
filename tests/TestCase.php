<?php

namespace Tests;

use BadMethodCallException;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // public function __call($httpMethod, $args = [])
    // {
    //     if (in_array($httpMethod, ['get', 'post', 'put', 'patch', 'delete']))
    //     {
    //         return $this->call($httpMethod, $args);
    //     }    
    //     throw new BadMethodCallException;
    // }
}
