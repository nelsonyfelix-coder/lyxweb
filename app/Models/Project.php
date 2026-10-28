<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title', 'slug', 'category', 'short_description', 'description', 'technologies',
    'live_url', 'repository_url', 'cover_image_url', 'accent_color', 'is_featured',
    'is_published', 'sort_order',
])]
class Project extends Model
{
    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }
}
