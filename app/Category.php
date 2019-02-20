<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Tax::class);
    }
}
