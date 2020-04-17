<?php

namespace Tests\Unit;

use DatabaseMigrations;
use Tests\TestCase;

class NodeTest extends TestCase
{


    public function testCheckingFilesInDataBase()
    {
        $this->assertDatabaseHas('nodes', ['name' => 'C:', 'parent_id' => null]);
    }


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
