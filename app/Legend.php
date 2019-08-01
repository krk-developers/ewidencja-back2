<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class Legend extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];

    /**
     * Get the events for the legend.
     * 
     * @return HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany('App\Event');
    }

    /**
     * Scope a query to only include legends of a given name.
     *
     * @param Builder $query Query
     * @param string  $name  Name
     * 
     * @return Builder
     */
    public function scopeOfName(Builder $query, $name): Builder
    {
        return $query->where('name', $name);
    }

    /**
     * Find Legend by its primary key.
     *
     * @param integer $id Primary key
     * 
     * @return Legend
     */
    public static function find_(int $id): Legend
    {
        return self::find($id);
    }
    
    /**
     * All event's legend sorted by name
     *
     * @return Collection
     */
    public static function allSortBy(): Collection
    {
        $legends = self::all();
        $collection = collect($legends);
        $sorted = $collection->sortBy('name');

        return $sorted;
    }

    /**
     * Create legend
     *
     * @param array $data Data
     * 
     * @return Legend
     */
    public static function create_(array $data): Legend
    {
        return self::create(
            [
                'name' => $data['name'],
                'display_name' => $data['display_name'],
                'description' => $data['description'],
            ]
        );
    }

    /**
     * Delete record by primary key.
     * Return 0 or 1.
     *
     * @param integer $id Primary key
     * 
     * @return int
     */
    public static function destroy_(int $id): int
    {
        return self::destroy($id);
    }
}
