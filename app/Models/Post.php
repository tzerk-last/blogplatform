<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Post extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'title', 'slug', 'body', 'cover_image', 'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
