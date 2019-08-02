<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Worker extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname', 'pesel',
        'equivalent',
        'equivalent_amount',
        'effective'
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
     * The employers that belong to the worker.
     */
    public function employers(): BelongsToMany
    {
        return $this->belongsToMany('App\Employer')
            ->withPivot('contract_from', 'contract_to', 'part_time');
    }

    /**
     * Get the events for the user.
     * 
     * @return HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany('App\Event')->orderBy('start');
    }

    /**
     * Worker's events beetwen dates.
     *
     * @param string $start Start date
     * @param string $end   End   date
     * 
     * @return Collection
     */
    public function eventsByTimePeriod(string $start, string $end): Collection
    {
        return DB::table('events')
            ->select(
                'events.id', 'events.worker_id', 'events.start',
                'events.end', 'events.title',
                'legends.id as legend_id', 'legends.name as legend_name',
                'legends.display_name as legend_display_name',
                'legends.description as legend_description'
            )
            ->join('legends', 'events.legend_id', 'legends.id')
            ->where('worker_id', $this->id)
            ->whereDate('start', '>=', $start)
            ->whereDate('end', '<=', $end)
            ->get();
    }

    /**
     * Worker's events between dates at the given employer.
     *
     * @param integer $employerID Emplopyer id
     * @param string $start Start date
     * @param string $end End date
     * 
     * @return Collection
     */
    public function eventsByEmployerID(
        int $employerID,
        string $start,
        string $end
    ): Collection {
        return DB::table('events')
            ->select(
                'events.id', 'events.worker_id', 'events.employer_id',
                'events.start', 'events.end', 'events.title',
                'legends.name as legend_name',
                'legends.display_name as legend_display_name',
                'legends.description as legend_description'
            )
            ->join('legends', 'events.legend_id', 'legends.id')
            ->where('employer_id', $employerID)
            ->where('worker_id', $this->id)
            ->whereDate('start', '>=', $start)
            ->whereDate('end', '<=', $end)
            ->orderBy('start', 'asc')
            ->get();
    }

    public function eventsByEmployerID1(
        int $employerID,
        string $start,
        string $end
    ): array {
        return DB::select(
            "SELECT
                DATE_FORMAT(start, '%Y-%m-%dT%T') as start,
                DATE_FORMAT(end, '%Y-%m-%dT%T') as end,
                title
            FROM
                events"
        );
        /*
            ->select(
                'events.id', 'events.worker_id', 'events.employer_id',
                selectRaw(DATE_FORMAT(start, '%Y-%m-%dT%T')),
                selectRaw(DATE_FORMAT(end, '%Y-%m-%dT%T')),
                'events.title',
                'legends.name as legend_name',
                'legends.display_name as legend_display_name',
                'legends.description as legend_description'
            )
            ->join('legends', 'events.legend_id', 'legends.id')
            ->where('employer_id', $employerID)
            ->where('worker_id', $this->id)
            ->whereDate('start', '>=', $start)
            ->whereDate('end', '<=', $end)
            ->orderBy('start', 'asc')
            ->get();
        */
    }

    /**
     * Childrencare day count
     *
     * @param integer $workerID Worker ID
     * @param integer $year     Year
     * 
     * @return int
     */
    public static function childcareDay(int $workerID, int $year): Collection
    {
        return DB::table('events')
            ->select('start', 'end')
            ->join('legends', 'events.legend_id', 'legends.id')
            ->where('events.worker_id', $workerID)
            ->whereRaw("YEAR(events.start) = ?", [$year])
            ->where('legends.name', 'DOD')
            ->orderBy('start')
            ->get();
    }

    /**
     * Workers's event in time period
     *
     * @param string $start      Period start
     * @param string $end        Period end
     * @param int    $employerID Employer ID
     * 
     * @return void
     */
    public function eventsByTimePeriod1(string $start, string $end, int $employerID)
    {
        return DB::table('events')
            ->select(
                'events.id', 'events.worker_id', 'events.start',
                'events.end', 'events.title',
                'legends.id as legend_id', 'legends.name as legend_name',
                'legends.display_name as legend_display_name',
                'legends.description as legend_description'
            )
            ->join('legends', 'events.legend_id', 'legends.id')
            ->where('worker_id', $this->id)
            ->where('employer_id', $employerID)
            ->whereDate('start', '>=', $start)
            ->whereDate('end', '<=', $end)
            ->get();
    }

    /**
     * Create profile
     * 
     * @param array $data User data
     * 
     * @return Worker
     */
    public static function createRow(array $data): Worker
    {
        return self::create($data);
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

    /**
     * Find by primary key
     *
     * @param integer $workerID Primary key
     * 
     * @return Worker
     */
    public static function findRow(int $workerID): ?Worker
    {
        return self::find($workerID);
    }
    
    /**
     * All events assigned to workers.
     *
     * @return void
     */
    
    public static function all_(): Collection
    {
        return Worker::with(
            [
                'employers:employers.id,employers.company',
                'user'
            ]
        )
        ->get();
    }
    

    public static function all__(): Collection
    {
        return DB::table('workers')
            ->select('users.name', 'workers.id', 'workers.lastname', 'workers.pesel')
            ->join('users', 'workers.id', '=', 'users.userable_id')
            ->join('types', 'users.type_id', '=', 'types.id')
            ->where('types.name', 'worker')
            ->orderBy('name')
            ->get();
    }

    /**
     * Workers sorted by last name
     *
     * @return Collection
     */
    public static function allSortBy(): Collection
    {
        $workers = self::all();
        $collection = collect($workers);
        $sorted = $collection->sortBy('lastname');

        return $sorted;
    }

    /**
     * Delete worker
     *
     * @return boolean
     */
    public function deleteRow(): bool
    {
        // remove a many-to-many relationship record
        $this->employers()->detach();

        // remove user
        $this->user->delete();

        // remove worker
        return $this->delete();
    }

    /**
     * Attach the employer to the worker
     *
     * @param array $data Worker data
     * 
     * @return array
     */
    public function addEmployer(array $data): array
    {
        try {
            $this->employers()->attach(
                $data['employer_id'],
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
     * Detach the employer from the worker
     *
     * @param integer $employerID Employer ID
     * 
     * @return integer 0|1
     */
    public function removeEmployer(int $employerID): int
    {
        return $this->employers()->detach($employerID);
    }
}
