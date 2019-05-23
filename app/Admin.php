<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;

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
     * Admins sorted by las name
     *
     * @return Collection
     */
    public static function allSortBy(): Collection
    {
        $admins = self::all();
        $collection = collect($admins);
        $sorted = $collection->sortBy('lastname');

        return $sorted;
    }
    
    /**
     * Create Admin
     *
     * @param array $data Request data
     * 
     * @return Admin
     */
    public static function createRow(array $data): Admin
    {
        return self::create($data);
    }

    /**
     * Delete Admin
     *
     * @return void
     */
    public function deleteRow(): void
    {
        $this->user->delete();
        $this->delete();
    }
}
