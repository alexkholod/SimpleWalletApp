<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $wallet_id
 * @property int $category_id
 * @property float $value
 * @property string|null $comment
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */

class Cost extends Model
{
    public function wallet(): BelongsTo
    {
        return $this->belongsTo('App\Models\Wallet'); //wallet_id
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Models\Category'); //category_id
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User'); //user_id
    }

}
