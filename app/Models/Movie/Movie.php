<?php

namespace App\Models\Movie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class);
    }
}
