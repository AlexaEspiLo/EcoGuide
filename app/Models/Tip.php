<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tip extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'image',
        'user_id',
    ];



    public function Likes()
    {
        return $this->hasMany(Like::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function isLikedByLoggedInUser()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
}
