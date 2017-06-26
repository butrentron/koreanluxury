<?php

namespace App;

use Baum\Node;

use Illuminate\Database\Eloquent\Model;

class Page extends Node
{
    protected $table = 'pages';

    protected $fillable = ['name', 'uri', 'content', 'hidden', 'set_title', 'meta_key', 'meta_desc'];

    public function updateOrder($order, $orderPage)
    {
        $orderPage = $this->findOrFail($orderPage);
        if ($order == 'childOf') {
            $this->makeChildOf($orderPage);
        }
    }

    public function setHiddenAttribute($value)
    {
        $this->attributes['hidden'] = $value ?: 0;
    }

    public function paddedName()
    {
        return str_repeat('-', $this->depth * 4). ' ' .$this->name;
    }

}
