<?php

namespace Tests\Unit;


use App\Node;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NodeTest extends TestCase
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


    public function testCreateNewFileInDataBase()
    {
        $this->assertDatabaseHas('nodes', ['name' => 'X:', 'parent_id' => null]);
        $this->assertDatabaseHas('nodes', ['name' => 'L1', 'parent_id' => $this->root->id]);
    }

    public function testRoute()
    {
        $this->assertEquals($this->leaf->route, "X:\L1\L2\L3\leaf");
    }


}
