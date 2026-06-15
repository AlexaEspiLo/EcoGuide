<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'tip_id',
        'user_id',
        'content',
    ];

    public function tip()
    {
        return $this->belongsTo(Tip::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}