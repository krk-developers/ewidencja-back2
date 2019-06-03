<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
     * The employers that belong to the admin.
     *
     * @return BelongsToMany
     */
    public function employers(): BelongsToMany
    {
        return $this->belongsToMany('App\Employer');
    }

    /**
     * Find Admin by primary key
     *
     * @param integer $adminID Admin ID
     * 
     * @return Admin
     */
    public static function findRow(int $adminID): Admin
    {
        return self::find($adminID);
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

    /**
     * Attach the employer to the administrator
     *
     * @param int $adminID    Admin    ID
     * @param int $employerID Employer ID
     * 
     * @return array Array with keys: status and message
     */
    public static function addEmployer(int $adminID, int $employerID): array
    {
        $admin = self::findRow($adminID);
        
        try {
            $admin->employers()->attach($employerID);  // null

            return [
                'status' => 'success',
                'message' => 'Dodano'
            ];
        } catch (\Illuminate\Database\QueryException $e) {
            return [
                'status' => 'danger',
                'message' => $e->getMessage()
            ];

        } catch (\PDOException $e) {
            return [
                'status' => 'danger',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Detach a single Employer from the Admin
     *
     * @param integer $adminID    Admin    ID
     * @param integer $employerID Employer ID
     * 
     * @return integer
     */
    public static function removeEmployer(int $adminID, int $employerID): int
    {
        $admin = self::findRow($adminID);  // 0|1

        return $admin->employers()->detach($employerID);
    }
}
