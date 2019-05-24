<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Province extends Model
{
    /**
     * Get the employers for the province.
     *
     * @return HasMany
     */
    public function employers(): HasMany
    {
        return $this->hasMany('App\Employer');
    }

    /**
     * All provinces
     *
     * @return Collection
     */
    public static function allRows(): Collection
    {
        return self::all();
    }
}
