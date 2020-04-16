<?php

use App\Node;
use Illuminate\Database\Seeder;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = Node::create(['name' => 'c']);
        $level1 = Node::create(['name' => 'L1', 'parent_id' => $root->id]);
        $level2 = Node::create(['name' => 'L2', 'parent_id' => $level1->id]);
        $level3 = Node::create(['name' => 'L3', 'parent_id' => $level2->id]);
        $leaf = Node::create(['name' => 'leaf', 'parent_id' => $level3->id]);
    }
}
