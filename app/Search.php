<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

/**
 * Search workers and employers
 */
class Search extends Model
{
    /**
     * Search workers by lastname and pesel.
     *
     * @param string $term Search term
     * 
     * @return Collection
     */
    public function workers(string $term): Collection
    {
        if (is_numeric($term)) {
            return $this->byPesel($term);
        }
        
        $a = DB::table('workers')
            ->where('lastname', '=', $term);
        
        $b = DB::table('workers')
            ->where('lastname', 'like', "$term%");

        $c = DB::table('workers')
            ->where('lastname', 'like', "%$term");

        $d = DB::table('workers')
            ->union($a)
            ->union($b)
            ->union($c)
            ->where('lastname', 'like', "%$term%");

        return $d->get();
    }

    /**
     * Search workers by pesel/
     *
     * @param string $term Pesel
     * 
     * @return Collection
     */
    private function byPesel(string $term): Collection
    {
        $a = DB::table('workers')
            ->where('pesel', '=', $term);

        $b = DB::table('workers')
            ->where('pesel', 'like', "$term%");
        
        $c = DB::table('workers')
            ->where('pesel', 'like', "%$term");

        $d = DB::table('workers')
            ->union($a)
            ->union($b)
            ->union($c)
            ->where('pesel', 'like', "%$term%");
        
        return $d->get();
    }

    /**
     * Search employers by company name and nip
     *
     * @param string $term Search term
     * 
     * @return Collection
     */
    public function employers(string $term): Collection
    {
        if (is_numeric($term)) {
            return $this->byNip($term);
        }

        $a = DB::table('employers')
            ->where('company', '=', $term);
        
        $b = DB::table('employers')
            ->where('company', 'like', "$term%");

        $c = DB::table('employers')
            ->where('company', 'like', "%$term");

        $d = DB::table('employers')
            ->union($a)
            ->union($b)
            ->union($c)
            ->where('company', 'like', "%$term%");

        return $d->get();
    }

    /**
     * Search employers by nip
     *
     * @param string $term Nip
     * 
     * @return Collection
     */
    private function byNip(string $term): Collection
    {
        $a = DB::table('employers')
            ->where('nip', '=', $term);

        $b = DB::table('employers')
            ->where('nip', 'like', "$term%");
        
        $c = DB::table('employers')
            ->where('nip', 'like', "%$term");

        $d = DB::table('employers')
            ->union($a)
            ->union($b)
            ->union($c)
            ->where('nip', 'like', "%$term%");
        
        return $d->get();
    }
}
