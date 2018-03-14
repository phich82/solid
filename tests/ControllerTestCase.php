<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller;

/**
 * Controller Test Case
 *
 * Provides some useful methods for testing Laravel Controllers.
 *
 */
abstract class ControllerTestCase extends TestCase
{
    /* reset session before each test, otherwise, session state is retained across multiple tests */
    public function setUp()
    {
        parent::setUp();
        \Laravel\Session::load();
    }

    /**
	 * Call a controller method.
	 *
	 * It is an alias for Laravel's Controller::call() with the option to specify a request method.
	 *
	 * @param	string	$method
	 * @param	array	$arguments
	 * @param	string	$method
	 * @return	\Laravel\Response
	 */
    public function call($method, $arguments = [], $httpMethod = 'GET')
    {
        // $httpOldMethod = Request::foundation()->getMethod();
        // \Laravel\Request::foundation()->setMethod($httpMethod);
        // $response = Controller::call($method, $arguments);
        // Request::foundation()->setMethod($httpOldMethod);
        // return $response;
        Request::foundation()->server->add(['REQUEST_METHOD' => $httpMethod]);
        return Controller::call($method, $arguments);
    }

    /**
	 * Alias for call()
	 *
	 * @param	string	$method
	 * @param	array	$arguments
	 * @return	\Laravel\Response
	 */
    public function get($method, $arguments = [])
    {
        return $this->call($method, $arguments, 'GET');
    }

    /**
	 * Make a POST request to a controller method
	 *
	 * @param	string	$method
	 * @param	array	$dataPost
	 * @param	array	$arguments
	 * @return	\Laravel\Response
	 */
    public function post($method, $dataPost, $arguments = [])
    {
        $this->clearRequest();
        \Laravel\Request::foundation()->request()->add($dataPost);
        return $this->call($method, $arguments, 'POST');
    }

    private function clearRequest()
    {
        $request = \Laravel\Request::foundation()->request;
        foreach ($request->keys() as $key) {
            $request->remove($key);
        }
    }
}