<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
        'company',
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
     */
    public function workers()
    {
        return $this->belongsToMany('App\Worker');
    }

    /**
     * All employers
     *
     * @return Collection
     */
    public static function all_(): Collection
    {
        return DB::table('employers')
            ->select(
                'employers.id', 'employers.company',
                'users.name as firstname', 'users.email',
                'types.display_name'
            )
            ->join('users', 'employers.id', '=', 'users.userable_id')
            ->join('types', 'users.type_id', '=', 'types.id')
            ->where('types.name', '=', 'employer')
            ->get();
    }

    /**
     * Workers who work for the employer
     *
     * @param integer $id Employer identifier
     * 
     * @return Collection
     */
    public static function workersByEmployerID(int $id): Collection
    {
        return DB::table('workers')
            ->select(
                'workers.id', 'users.name as firstname', 'workers.lastname',
                'users.email', 'types.display_name as type_display_name'
            )
            ->join('employer_worker', 'workers.id', '=', 'employer_worker.worker_id')
            ->join('users', 'workers.id', '=', 'users.userable_id')
            ->join('types', 'users.type_id', '=', 'types.id')
            ->where(
                [
                    ['employer_worker.employer_id', '=', $id],
                    ['types.name', '=', 'worker']
                ]
            )
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
     * @return Employer
     */
    public static function create_(): Employer
    {
        return self::create();
    }
}
