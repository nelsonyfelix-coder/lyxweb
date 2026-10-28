<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'summary', 'icon', 'technologies', 'is_visible', 'sort_order'])]
class Service extends Model
{
    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'is_visible' => 'boolean',
        ];
    }
}
