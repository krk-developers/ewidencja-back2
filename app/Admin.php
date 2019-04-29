<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Admin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname',
    ];

    /**
     * Get the profile's user.
     * 
     * @return MorphOne
     */
    public function user(): MorphOne
    {
        return $this->morphOne('App\User', 'userable');
    }

    /**
     * Create admin
     *
     * @param array $data Request data
     * 
     * @return Admin
     */
    public static function create_(array $data): Admin
    {
        return self::create($data);
    }

    public function delete_()
    {
        $this->user->delete();
        $this->delete();
    }
}
