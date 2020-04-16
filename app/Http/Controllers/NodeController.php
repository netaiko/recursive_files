<?php

namespace App\Http\Controllers;

use App\Node;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NodeController extends Controller
{
    private $search;
    private $nodes_found;

    public function __construct()
    {
        $this->nodes_found = [];
    }


    /**
     * @return Factory|View
     */
    function index(Request $request)
    {
        $root = Node::whereNull('parent_id')->first();

        $this->search = $request->search;


        $this->dfs($root);

        return view('welcome')
            ->with([
                'nodes' => $this->nodes_found, 'search' => $request->search]);
    }


    /**
     * Recursive function based in the Depth-first Search algorithm
     * adding name searched to a list
     * @param Node $node
     * @return Node
     */
    function dfs(Node $node)
    {
        if ($node->isSimilarName($this->search)) {
            $this->nodes_found[] = $node;
        }

        foreach ($node->children as $child) {
            $this->dfs($child);
        }
        return $node;
    }


}
