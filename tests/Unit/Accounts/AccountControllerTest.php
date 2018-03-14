<?php

namespace Tests\Unit\Accounts;

use Tests\TestCase;
use Tests\ControllerTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountControllerTest extends ControllerTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSignupWhenNoData()
    {
        $response = $this->post('account@signup', []);
        $this->assertEquals('302', $response->foundation->getStatusCode());
        $errorsSession = \Laravel\Session::instance()->get('errors')->all();
        $this->assertNotEmpty($errorsSession);
    }

    public function testSignupWhenDataIsValid()
    {
        $dataPost = [
            'username'         => 'validusername',
            'email'            => 'some@validemail.com',
            'password'         => 'passw0rd',
            'password_confirm' => 'passw0rd',
        ];
        $response = $this->post('account@signup', $dataPost);

        $this->assertEquals('302', $response->foundation->getStatusCode());

        $errorsSession = \Laravel\Session::instance()->get('errors');
        $this->assertNull($errorsSession);
    }
}
