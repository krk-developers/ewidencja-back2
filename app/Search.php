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
            return $this->workersByPesel($term);
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
    private function workersByPesel(string $term): Collection
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
     * Search employers by company name and nip.
     *
     * @param string $term       Search term
     * @param string $userType   User type
     * @param string $userableID Userable id
     * 
     * @return Collection
     */
    public function employers(
        string $term,
        string $userType,
        string $userableID
    ): Collection {
        if (is_numeric($term)) {
            return $this->employersByNip($term, $userType, $userableID);
        }

        $a = DB::table('employers');
        $a->select('employers.id', 'employers.company', 'employers.nip');
        if ($userType == 'admin') {
            $a->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $a->where('admin_employer.admin_id', '=', $userableID);
        }
        $a->where('company', '=', $term);
        
        $b = DB::table('employers');
        $b->select('employers.id', 'employers.company', 'employers.nip');
        if ($userType == 'admin') {
            $b->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $b->where('admin_employer.admin_id', '=', $userableID);
        }
        $b->where('company', 'like', "$term%");

        $c = DB::table('employers');
        $c->select('employers.id', 'employers.company', 'employers.nip');
        if ($userType == 'admin') {
            $c->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $c->where('admin_employer.admin_id', '=', $userableID);
        }
        $c->where('company', 'like', "%$term");

        $d = DB::table('employers');
        $d->select('employers.id', 'employers.company', 'employers.nip');
        if ($userType == 'admin') {
            $d->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $d->where('admin_employer.admin_id', '=', $userableID);
        }
        $d->union($a);
        $d->union($b);
        $d->union($c);
        $d->where('company', 'like', "%$term%");

        return $d->get();
    }

    /**
     * Search employers by nip.
     *
     * @param string $term       Nip
     * @param string $userType   User type
     * @param string $userableID Userable id
     * 
     * @return Collection
     */
    private function employersByNip(
        string $term,
        string $userType,
        string $userableID
    ): Collection {
        $a = DB::table('employers');
        $a->select('employers.id', 'employers.company', 'employers.nip');
        if ($userType == 'admin') {
            $a->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $a->where('admin_employer.admin_id', '=', $userableID);
        }
        $a->where('nip', '=', $term);

        $b = DB::table('employers');
        $b->select('employers.id', 'employers.company', 'employers.nip');
        if ($userType == 'admin') {
            $b->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $b->where('admin_employer.admin_id', '=', $userableID);
        }
        $b->where('nip', 'like', "$term%");
        
        $c = DB::table('employers');
        $c->select('employers.id', 'employers.company', 'employers.nip');
        if ($userType == 'admin') {
            $c->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $c->where('admin_employer.admin_id', '=', $userableID);
        }
        $c->where('nip', 'like', "%$term");

        $d = DB::table('employers');
        $d->select('employers.id', 'employers.company', 'employers.nip');
        if ($userType == 'admin') {
            $d->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $d->where('admin_employer.admin_id', '=', $userableID);
        }
        $d->union($a);
        $d->union($b);
        $d->union($c);
        $d->where('nip', 'like', "%$term%");
        
        return $d->get();
    }
}
