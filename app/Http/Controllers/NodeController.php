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
    private $paths_found;

    public function __construct()
    {
        $this->nodes_found = [];
        $this->paths_found = [];
    }


    /**
     * @return Factory|View
     */
    function index(Request $request)
    {
        $root = Node::whereNull('parent_id')->first();

        if ($this->search = $request->search) {
            $this->dfs($root);
        }

        return view('welcome')
            ->with([
                'paths' => $this->paths_found, 'search' => $request->search]);
    }


    /**
     * Recursive function based in the Depth-first Search algorithm
     * adding name searched to a list
     * @param Node $node
     * @return Node
     */
    function dfs(Node $node, $path = '')
    {
        $path .= empty($path) ? $node->name : "\\$node->name";
        if ($node->isSimilarName($this->search)) {
            $this->nodes_found[] = $node;
            $this->paths_found[] = $path;
        }

        foreach ($node->children as $child) {
            $this->dfs($child, $path);
        }
        return $node;
    }


}
