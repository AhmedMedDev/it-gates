<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'notes',
        'due_date',
        'is_completed',
        'user_id',
    ];

    public static function insert(array $attributes = []): Todo
    {
        $attributes['user_id'] = auth()->user()->id;
        return parent::create($attributes);
    }
}
