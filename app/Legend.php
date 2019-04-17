<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

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
    protected $fillable = ['name', 'display_name', 'description', 'working_day'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'working_day' => 1,
    ];

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
     * All event's legend
     *
     * @return Collection
     */
    public static function all_(): Collection
    {
        return self::all();
    }

    public static function create_(array $data): Legend
    {
        return self::create(
            [
                'name' => $data['name'],
                'display_name' => $data['display_name'],
                'description' => $data['description'],
                'working_day' => $data['working_day'],
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
