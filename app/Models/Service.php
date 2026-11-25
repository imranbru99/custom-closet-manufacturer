<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'slug', 'icon', 'summary', 'body', 'image',
        'starting_price', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'starting_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }
}
