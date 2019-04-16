<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id',
        'userable_id',
        'userable_type',
        'name',
        'email',
        'password',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token', // <- ? moze byc tu i tu?
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the type that owns the user.
     * 
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo('App\Type');
    }

    /**
     * Get all of the owning userable models.
     * Info about user profile.
     * 
     * @return MorphTo
     */
    public function userable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Collection of Users
     *
     * @return Collection
     */
    public static function all_(): Collection
    {
        // return self::all();
        return DB::table('users')
            ->select(
                'users.id', 'users.name as firstname',
                'users.email', 'types.display_name as type_display_name',
                'types.description'
            )
            ->join('types', 'users.type_id', '=', 'types.id')
            ->get();
    }
}
