<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public function costs()
    {
        return $this->hasMany('App\Models\Cost', 'wallet_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
