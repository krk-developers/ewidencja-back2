<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'start', 'end', 'title',];

    /**
     * Get the user that owns the event.
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the legend that owns the event.
     * 
     * @return BelongsTo
     */
    public function legend(): BelongsTo
    {
        return $this->belongsTo('App\Legend');
    }    
}
