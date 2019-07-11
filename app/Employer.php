<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Employer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company', 'nip', 'street', 'zip_code', 'city', 'province_id'
    ];
       
    /**
     * String representation of model
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__;
    }
    
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
     * The workers that belong to the employer.
     * 
     * @return BelongsToMany
     */
    public function workers(): BelongsToMany
    {
        return $this->belongsToMany('App\Worker');
    }

    /**
     * Get the province that owns the employer's address.
     *
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo('App\Province');
    }

    /**
     * The admins that belong to the employer.
     *
     * @return BelongsToMany
     */
    public function admins(): BelongsToMany
    {
        return $this->belongsToMany('App\Admin');
    }

    /**
     * Find by primary key
     *
     * @param integer $employerID Employer ID
     * 
     * @return Employer
     */
    public static function findRow(int $employerID): ?Employer
    {
        return self::find($employerID);
    }

    /**
     * Save Employer
     *
     * @return boolean
     */
    public function saveRow(): bool
    {
        return $this->save();
    }
    
    /**
     * Save morph User
     *
     * @return boolean
     */
    public function saveUserRow(): bool
    {
        return $this->user->save();
    }

    /**
     * All employers
     *
     * @return Collection
     */
    /*
    public static function all_(): Collection
    {
        return DB::table('employers')
            ->select(
                'employers.id', 'employers.company',
                'users.name as firstname', 'users.email',
                'types.display_name as type_display_name'
            )
            ->join('users', 'employers.id', '=', 'users.userable_id')
            ->join('types', 'users.type_id', '=', 'types.id')
            ->where('types.name', '=', 'employer')
            ->get();
    }
    */

    /**
     * All employers in alphabetical order
     *
     * @return Collection
     */
    public static function all__(): Collection
    {
        return DB::table('employers')
            ->select('id', 'company')
            ->orderBy('company')
            ->get();
    }
    
    /**
     * All employers, sort by comany name
     * 
     * @return Collection
     */
    public static function allSortBy(): Collection
    {
        $employers = self::all();
        $collection = collect($employers);
        $sorted = $collection->sortBy('company');

        return $sorted;
    }

    /**
     * Delete Employer
     *
     * @return boolean
     */
    public function deleteRow(): bool
    {
        // remove a many-to-many relationship record
        $this->workers()->detach();

        // remove user
        if ($this->user) {
            $this->user->delete();
        }

        // remove worker
        return $this->delete();
    }

    /**
     * Workers who work for the employer
     *
     * @param integer $employerID Employer identifier
     * 
     * @return Collection
     */
    public static function workersByEmployerID(int $employerID): Collection
    {
        return DB::table('workers')
            ->select(
                'workers.id', 'users.name as firstname', 'workers.lastname',
                'workers.pesel', 'users.email',
                'types.display_name as type_display_name'
            )
            ->join('employer_worker', 'workers.id', '=', 'employer_worker.worker_id')
            ->join('users', 'workers.id', '=', 'users.userable_id')
            ->join('types', 'users.type_id', '=', 'types.id')
            ->where(
                [
                    ['employer_worker.employer_id', '=', $employerID],
                    ['types.name', '=', 'worker']
                ]
            )
            ->get();
    }

    public static function workersWithEventsByEmployerID(
        int $employerID,
        string $start,
        string $end
    ): Collection {
        return DB::table('workers')
            ->select(
                'workers.id', 'users.name as firstname', 'workers.lastname',
                'workers.pesel', 'users.email',
                'types.display_name as type_display_name',
                'events.start', 'events.end', 'events.title'
            )
            ->join('employer_worker', 'workers.id', '=', 'employer_worker.worker_id')
            ->join('users', 'workers.id', '=', 'users.userable_id')
            ->join('types', 'users.type_id', '=', 'types.id')
            ->join('events', 'workers.id', '=', 'events.worker_id')
            ->where(
                [
                    ['employer_worker.employer_id', '=', $employerID],
                    ['types.name', '=', 'worker']
                ]
            )
            ->whereDate('events.start', '>=', $start)
            ->whereDate('events.end', '<=', $end)
            ->get();
    }
    
    /**
     * Events of the worker who works for the employer
     *
     * @param integer $employerID Employer identifier
     * @param integer $workerID   Worker   identifier
     * 
     * @return Collection
     */
    public static function eventsByEmployerAndWorkerID(
        int $employerID,
        int $workerID
    ): Collection {
        return DB::table('events')
            ->select(
                'events.id', 'events.start', 'events.end', 'events.title',
                'legends.name as legend_name',
                'legends.display_name as legend_display_name'
            )
            ->join(
                'employer_worker', 'events.worker_id',
                'employer_worker.worker_id'
            )
            ->join('legends', 'events.legend_id', 'legends.id')
            ->where(
                [
                    ['events.worker_id', $workerID],
                    ['employer_worker.employer_id', $employerID]
                ]
            )
            ->get();
    }
    
    /**
     * Create profile
     * 
     * @param array $data Data
     *
     * @return Employer
     */
    public static function createRow(array $data): Employer
    {
        return self::create($data);
    }

    /**
     * Assign worker to employer
     *
     * @param array $data Worker data
     * 
     * @return array Array with status and message
     */
    public function addWorker(array $data): array
    {
        try {
            $this->workers()->attach(
                $data['worker_id'],
                [
                    'contract_from' => $data['contract_from'],
                    'contract_to' => $data['contract_to'],
                    'part_time' => $data['part_time'],
                ]
            );  // null
            
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
     * Remove the worker from the employer's list
     * 
     * @param integer $workerID Worker ID
     * 
     * @return int 0|1
     */
    public function removeWorker(int $workerID): int
    {
        return $this->workers()->detach($workerID);
    }
}
