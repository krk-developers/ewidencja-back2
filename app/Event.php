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
    protected $fillable = ['user_id', 'start', 'end', 'title',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['user_id', 'legend_id', 'created_at', 'updated_at',];

    /**
     * Get the user that owns the event.
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo
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
     * Events assigned to worker
     *
     * @param integer $id Worker's identifier.
     * 
     * @return Collection
     */
    public static function byWorkerID(int $id): Collection
    {
        return DB::table('events')
            ->select(
                'events.id', 'events.start', 'events.end', 'events.title',
                'legends.name as legend_name',
                'legends.display_name as legend_display_name',
                'events.worker_id'
            )
            ->join('legends', 'events.legend_id', '=', 'legends.id')
            ->where('worker_id', $id)
            ->get();
    }
}
