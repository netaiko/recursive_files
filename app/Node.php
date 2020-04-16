<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Node::class);
    }

    public function children()
    {
        return $this->hasMany(Node::class, 'parent_id');
    }


    function getRouteAttribute()
    {
        $node = $this;
        $path = $this->name;
        while ($node->parent) {
            $path = $node->parent->name . '\\' . $path;
            $node = $node->parent;
        }
        return $path;
    }


    function isSimilarName($comparison)
    {
        return strpos(strtolower($this->name), strtolower($comparison)) !== false;
    }
}
