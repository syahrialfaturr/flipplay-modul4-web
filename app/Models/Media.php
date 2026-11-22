<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'genre',
        'description',
        'rating',
        'type',
        'episode',
        'chapter',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_media')
                    ->withTimestamps();
    }
}
