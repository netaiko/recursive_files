<?php

namespace App\Http\Controllers;

use App\Node;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

class LoadFileController extends Controller
{

    const TEXTFILE = 'files.txt';

    private $lines;

    public function run()
    {
        $this->loadFile(self::TEXTFILE);
        $this->store();
    }

    /**
     * load file from the disk
     * @param $file
     * @throws FileNotFoundException
     */
    function loadFile($filename)
    {
        $file = Storage::disk('public')->get($filename);
        $this->lines = explode("\n", $file);
    }


    function store()
    {
        foreach ($this->lines as $line) {
            $this->addLine($line);
        }
    }

    /**
     * store node it in the DB from a line
     * @param $line
     */
    function addLine($line)
    {
        $slugs = explode("\\", $line);

        foreach ($slugs as $key => $slug) {
            if ($slug) { //todo validate
                $parent = Node::firstOrCreate(['name' => $slug, 'parent_id' => $parent->id ?? null]);
            }
        }
    }


}
