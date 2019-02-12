<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tax extends Model
{
    protected $table = 'taxes';

    protected $fillable = [
        'name',
        'value',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Tax::class);
    }
}
