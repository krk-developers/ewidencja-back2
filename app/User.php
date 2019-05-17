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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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

    public static function find_(int $id): User
    {
        return self::find($id);
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

    public static function employers(): Collection
    {
        $users = self::all();

        $employers = $users->filter(
            function ($value) {
                return $value->userable_type === 'App\Employer';
            }
        );

        return ($employers);
    }

    /**
     * Create User
     *
     * @param array $data User data
     * 
     * @return User
     */
    public static function createRow(array $data): User
    {
        return User::create(
            [
                'type_id' => $data['type_id'],  // user's type
                'userable_id' => $data['userable_id'],  // user's profile id
                'userable_type' => $data['userable_type'],  // user's profile type
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => Str::random(60),
            ]
        );
    }
    
    /**
     * Set attributes on the model and save it.
     *
     * @return boolean
     */
    public function saveRow(): bool
    {
        return self::save();
    }

    public static function byType(string $name): Collection
    {
        return DB::table('users')
            ->select(
                'users.id', 'users.userable_id',
                'users.name as firstname', 'users.email',
                'types.display_name as type_display_name',
                'types.description'
            )
            ->join('types', 'users.type_id', '=', 'types.id')
            ->where('types.name', $name)
            ->get();
    }

    /**
     * Get api token for the user
     *
     * @param integer $id User ID
     * 
     * @return string API Token
     */
    public static function apiToken(int $id): string
    {
        return DB::table('users')->where('id', $id)->value('api_token');
    }
}
