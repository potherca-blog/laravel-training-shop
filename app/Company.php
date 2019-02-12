<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'name'
    ];

    /**
     * Get the company of this user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
