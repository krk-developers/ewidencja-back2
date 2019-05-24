<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'legend_id',
        'employer_id',
        'worker_id',
        'employer_id',
        'start',
        'end',
        'title'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = ['worker_id', 'legend_id', 'created_at', 'updated_at',];

    /**
     * Get the user that owns the event.
     * 
     * @return BelongsTo
     */
    public function worker(): BelongsTo
    {
        return $this->belongsTo('App\Worker');
    }

    /**
     * Get the legend that owns the event.
     * 
     * @return BelongsTo
     */
    public function legend(): BelongsTo
    {
        return $this->belongsTo('App\Legend');
    }

    /**
     * All events
     *
     * @return Collection
     */
    public static function all_(): Collection
    {
        // return self::all();
        return DB::table('workers')
            ->select(
                'events.id', 'events.start', 'events.end', 'events.title',
                'legends.name as legend_name',
                'legends.display_name as legend_display_name',
                'workers.id as worker_id', 'users.name as firstname',
                'workers.lastname', 'workers.pesel', 'users.email'
            )
            ->join('users', 'workers.id', '=', 'users.userable_id')
            ->join('types', 'users.type_id', '=', 'types.id')
            ->join('events', 'workers.id', '=', 'events.worker_id')
            ->join('legends', 'events.legend_id', '=', 'legends.id')
            ->where('types.name', 'worker')
            ->get();
    }

    /**
     * Create event
     *
     * @param array $data event's data
     * 
     * @return Event
     */
    public static function createRow(array $data): Event
    {
        $employerID = null;
        
        // employer_id is nullable
        if (isset($data['employer_id'])) {
            $employerID = $data['employer_id'];
        }

        return self::create(
            [
                'legend_id' => $data['legend_id'],
                'employer_id' => $employerID,
                'worker_id' => $data['worker_id'],
                'start' => $data['start'],
                'end' => $data['end'],
                'title' => $data['title'],
            ]
        );        
    }
    
    /**
     * Delete record by primary key.
     * Return 0 or 1.
     *
     * @param integer $eventID Primary key
     * 
     * @return int
     */
    public static function destroyRow(int $eventID): int
    {
        return self::destroy($eventID);
    }
    
    /**
     * Events assigned to worker.
     *
     * @param integer $workerID Worker's identifier
     * 
     * @return Collection
     */
    public static function byWorkerID(int $workerID): Collection
    {
        return DB::table('events')
            ->select(
                'events.id', 'events.start', 'events.end', 'events.title',
                'legends.name as legend_name',
                'legends.display_name as legend_display_name',
                'events.worker_id'
            )
            ->join('legends', 'events.legend_id', '=', 'legends.id')
            ->where('worker_id', $workerID)
            ->get();
    }

    /**
     * All public holidays
     *
     * @return Collection
     */
    public static function publicHolidays(int $year): Collection
    {
        return DB::table('events')
            ->select(
                'events.id', 'events.start', 'events.title',
                'legends.name as legend_name',
                'legends.display_name as legend_diplay_name',
                'legends.description as legend_description'
            )
            ->join('legends', 'legend_id', 'legends.id')
            ->where('legends.name', 'DZUW')
            ->whereRaw("YEAR(start) = ?", [$year])
            ->get();
    }

    /**
     * All public holidays
     *
     * @return Collection
     */
    public static function publicHolidaysInMonth(int $year, int $month): Collection
    {
        return DB::table('events')
            ->select(
                'events.id', 'events.start', 'events.title',
                'legends.name as legend_name',
                'legends.display_name as legend_diplay_name',
                'legends.description as legend_description'
            )
            ->join('legends', 'legend_id', 'legends.id')
            ->where('legends.name', 'DZUW')
            ->whereRaw("YEAR(start) = ?", [$year])
            ->whereRaw("MONTH(start) = ?", [$month])
            ->get();
    }

    /**
     * Nearest public holidays
     *
     * @return Collection
     */
    public static function nearestPublicHolidays(int $year): Collection
    {
        $nearestPublicHolidays = DB::table('events')
            ->select(
                'events.id', 'events.start', 'events.title',
                'legends.name as legend_name',
                'legends.display_name as legend_diplay_name',
                'legends.description as legend_description'
            )
            ->join('legends', 'legend_id', 'legends.id')
            ->where('legends.name', 'DZUW')
            ->whereDate('start', '>', today())
            ->whereRaw("YEAR(start) = ?", [$year])
            ->first();
        
        return collect($nearestPublicHolidays);
    }
}
