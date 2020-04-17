<?php

namespace Tests\Feature;

use App\Node;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    private $root;
    private $l1;
    private $l2;
    private $l3;
    private $m1;
    private $m2;
    private $r1;
    private $leaf;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRouteL2()
    {
        $response = $this->call('GET', '/', ['search' => 'l2']);
        $response->assertSuccessful();
        $response->assertViewHas(['paths']);
        $paths = $response->viewData('paths');
        $this->assertEquals("X:\L1\L2", $paths[0]);
    }

    public function testRouteR1()
    {
        $response = $this->call('GET', '/', ['search' => 'r1']);
        $response->assertSuccessful();
        $response->assertViewHas(['paths']);
        $paths = $response->viewData('paths');
        $this->assertEquals("X:\R1", $paths[0]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->root = Node::create(['name' => 'X:']);
        $this->l1 = Node::create(['name' => 'L1', 'parent_id' => $this->root->id]);
        $this->l2 = Node::create(['name' => 'L2', 'parent_id' => $this->l1->id]);
        $this->l3 = Node::create(['name' => 'L3', 'parent_id' => $this->l2->id]);
        $this->m1 = Node::create(['name' => 'M1', 'parent_id' => $this->root->id]);
        $this->m2 = Node::create(['name' => 'M2', 'parent_id' => $this->m1->id]);
        $this->r1 = Node::create(['name' => 'R1', 'parent_id' => $this->root->id]);
        $this->leaf = Node::create(['name' => 'leaf', 'parent_id' => $this->l3->id]);
    }
}
