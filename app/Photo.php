<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo_name', 'photo_description', 'album_id'
    ];

    /**
     * @return BelongsToMany
     */
    public function album(): BelongsToMany
    {
        return $this->belongsToMany(Album::class, 'id', 'album_id');
    }
}
