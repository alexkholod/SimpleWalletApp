<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function costs()
    {
        return $this->hasMany('App\Models\Cost', 'category_id');
    }
}
