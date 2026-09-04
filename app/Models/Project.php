<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'summary',
    ];

    protected function casts(): array
    {
        return [
            'last_entry_at' => 'datetime',
        ];
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
