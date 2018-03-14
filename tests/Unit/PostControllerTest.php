<?php

namespace Tests\Unit;

use Mockery;
use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    /* No use constructor function for initiating objects. Instead, using setUp() method */
    public function setUp()  
    {  
        parent::setUp();

        // We have no interest in testing Eloquent
        $this->mock = $this->mock('Eloquent', Post::class);  
        //$this->mock = Mockery::mock('Eloquent', 'Post');
    }

    public function tearDown()
    {
        Mockery::close();
    }

    private function mock($class)  
    {  
        // fake object (model)
        $mock = Mockery::mock($class);
        // IoC
        $this->app->instance($class, $mock);
        return $mock;  
    } 

    /**
     * Test for index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->call('GET', 'posts');
       // $response = $this->get('posts');
        $response->assertStatus(200);
        // check var 'posts' in view?
        $response->assertViewHas('posts');

        // getData() returns all vars attached to the response.
        $posts = $response->original->getData()['posts'];
 
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $posts);
    }

    public function testIndex2()
    {
        $this->mock->shouldReceive('all')->once()->andReturn(['foo']);
        $this->app->instance(Post::class, $this->mock);
        $response = $this->get('posts2');
        //$response->assertViewHas('posts');
    }
}
