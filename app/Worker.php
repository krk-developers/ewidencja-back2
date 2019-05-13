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
        return $this->belongsToMany('App\Employer');
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

    public function eventsByTimePeriod($start, $end)
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

    public function eventsByEmployerID(int $employerID, string $start, string $end)
    {
        // return DB::table('events')
        // ->where('employer_id', 1)->get()
        // return $this->events()
        return DB::table('events')
            ->select(
                'events.id', 'events.employer_id', 'events.worker_id', 
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
            // ->orderByRaw('start DESC')
            ->get();
    }

    /**
     * Childrencare day count
     *
     * @param integer $id   Worker ID
     * @param integer $year Year
     * 
     * @return int
     */
    public static function childcareDayCount(int $id, int $year): int
    {
        return DB::table('events')
            ->join('legends', 'events.legend_id', 'legends.id')
            ->where('events.worker_id', $id)
            ->whereRaw("YEAR(events.start) = ?", [$year])
            ->where('legends.name', 'DOD')
            ->count();
    }

    public function eventsByTimePeriod1($start, $end, $employer_id)
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
            ->where('employer_id', $employer_id)
            ->whereDate('start', '>=', $start)
            ->whereDate('end', '<=', $end)
            ->get();
    }

    /**
     * Create profile
     *
     * @return Worker
     */
    public static function create_(array $data): Worker
    {
        return self::create($data);
    }

    public static function find_(int $id)
    {
        return self::find($id);
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
        
        /*
        return DB::table('workers')
            ->select(
                'workers.id', 'users.name as firstname',
                'workers.lastname', 'workers.pesel', 'users.email',
                'types.display_name as type_display_name',
                'employers.id as employer_id', 'employers.company'
            )
            ->join('users', 'workers.id', '=', 'users.userable_id')
            ->join('types', 'users.type_id', '=', 'types.id')
            ->leftJoin(
                'employer_worker', 'workers.id', '=', 'employer_worker.worker_id'
            )
            ->leftJoin(
                'employers', 'employer_worker.employer_id', '=', 'employers.id'
            )
            ->where('types.name', 'worker')
            ->get();
        */
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

    public static function all___()
    {
        return self::all();
    }

    /**
     * Delete worker
     *
     * @return boolean
     */
    public function delete_(): bool
    {
        // remove a many-to-many relationship record
        $this->employers()->detach();

        // remove user
        $this->user->delete();

        // remove worker
        return $this->delete();
    }

    public function addEmployer(int $id): array
    {
        try {
            $this->employers()->attach($id);  // null

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

    public function removeEmployer(int $id)
    {
        return $this->employers()->detach($id);
    }
}
