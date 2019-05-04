<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Collection;

class SuperAdmin extends Model
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
     * Get the superadmin's user.
     *
     * @return MorphOne
     */
    public function user(): MorphOne
    {
        return $this->morphOne('App\User', 'userable');
    }

    /**
     * All Super Admins
     *
     * @return Collection
     */
    public static function all_(): Collection
    {
        return self::all();
    }
    
    /**
     * Create superadmin
     *
     * @param array $data Request data
     * 
     * @return SuperAdmin
     */
    public static function create_(array $data): SuperAdmin
    {
        return self::create($data);
    }

    /**
     * Remove 'userable' record from users's table
     * Remove record from super_admins's table
     *
     * @return boolean
     */
    public function delete_(): bool
    {
        $this->user->delete();
        return $this->delete();
    }
}
