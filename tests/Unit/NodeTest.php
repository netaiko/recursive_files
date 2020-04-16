<?php

namespace Tests\Unit;

use Tests\TestCase;


class NodeTest extends TestCase
{


    public function testGetRoutePath()
    {
        $response = $this->get('/');

        $response->assertStatus(201);


    }


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
