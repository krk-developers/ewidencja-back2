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
     * @param string $term       Search term
     * @param string $userType   User type
     * @param int    $userableID Userable id
     * 
     * @return Collection
     */
    public function workers(
        string $term,
        string $userType,
        int $userableID
    ): Collection {
        if (is_numeric($term)) {
            return $this->workersByPesel($term, $userType, $userableID);
        }
        
        $a = DB::table('workers');
        if ($userType == 'admin') {
            $a->join(
                'employer_worker',
                'workers.id',
                '=',
                'employer_worker.worker_id'
            );
            
            $a->join(
                'employers',
                'employer_worker.employer_id',
                '=',
                'employers.id'
            );
            
            $a->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $a->where('admin_employer.admin_id', '=', $userableID);
            
        }
        $a->where('lastname', '=', $term);
        
        $b = DB::table('workers');
        if ($userType == 'admin') {
            $b->join(
                'employer_worker',
                'workers.id',
                '=',
                'employer_worker.worker_id'
            );
            $b->join(
                'employers',
                'employer_worker.employer_id',
                '=',
                'employers.id'
            );
            $b->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $b->where('admin_employer.admin_id', '=', $userableID);
        }
        $b->where('lastname', 'like', "$term%");

        $c = DB::table('workers');
        if ($userType == 'admin') {
            $c->join(
                'employer_worker',
                'workers.id',
                '=',
                'employer_worker.worker_id'
            );
            $c->join(
                'employers',
                'employer_worker.employer_id',
                '=',
                'employers.id'
            );
            $c->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $c->where('admin_employer.admin_id', '=', $userableID);
        }
        $c->where('lastname', 'like', "%$term");

        $d = DB::table('workers');
        if ($userType == 'admin') {
            $d->join(
                'employer_worker',
                'workers.id',
                '=',
                'employer_worker.worker_id'
            );
            $d->join(
                'employers',
                'employer_worker.employer_id',
                '=',
                'employers.id'
            );
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
        $d->where('lastname', 'like', "%$term%");

        return $d->get();
    }

    /**
     * Search workers by pesel.
     *
     * @param string $term       Pesel
     * @param string $userType   User type
     * @param int    $userableID Userable id
     * 
     * @return Collection
     */
    private function workersByPesel(
        string $term,
        string $userType,
        int $userableID
    ): Collection {
        $a = DB::table('workers');
        if ($userType == 'admin') {
            $a->join(
                'employer_worker',
                'workers.id',
                '=',
                'employer_worker.worker_id'
            );
            $a->join(
                'employers',
                'employer_worker.employer_id',
                '=',
                'employers.id'
            );
            $a->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $a->where('admin_employer.admin_id', '=', $userableID);
            
        }
        $a->where('pesel', '=', $term);

        $b = DB::table('workers');
        if ($userType == 'admin') {
            $b->join(
                'employer_worker',
                'workers.id',
                '=',
                'employer_worker.worker_id'
            );
            $b->join(
                'employers',
                'employer_worker.employer_id',
                '=',
                'employers.id'
            );
            $b->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $b->where('admin_employer.admin_id', '=', $userableID);
        }
        $b->where('pesel', 'like', "$term%");
        
        $c = DB::table('workers');
        if ($userType == 'admin') {
            $c->join(
                'employer_worker',
                'workers.id',
                '=',
                'employer_worker.worker_id'
            );
            $c->join(
                'employers',
                'employer_worker.employer_id',
                '=',
                'employers.id'
            );
            $c->join(
                'admin_employer',
                'employers.id',
                '=',
                'admin_employer.employer_id'
            );
            $c->where('admin_employer.admin_id', '=', $userableID);
        }
        $c->where('pesel', 'like', "%$term");

        $d = DB::table('workers');
        if ($userType == 'admin') {
            $d->join(
                'employer_worker',
                'workers.id',
                '=',
                'employer_worker.worker_id'
            );
            $d->join(
                'employers',
                'employer_worker.employer_id',
                '=',
                'employers.id'
            );
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
        $d->where('pesel', 'like', "%$term%");
        
        return $d->get();
    }

    /**
     * Search employers by company name and nip.
     *
     * @param string $term       Search term
     * @param string $userType   User type
     * @param int    $userableID Userable id
     * 
     * @return Collection
     */
    public function employers(
        string $term,
        string $userType,
        int $userableID
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
     * @param int    $userableID Userable id
     * 
     * @return Collection
     */
    private function employersByNip(
        string $term,
        string $userType,
        int $userableID
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

    public function legend(string $term): Collection
    {
        $a = DB::table('legends');
        $a->where('name', '=', $term);

        $b = DB::table('legends');
        $b->where('display_name', '=', $term);

        $c = DB::table('legends');
        $c->where('name', '=', "%$term%");

        $d = DB::table('legends');
        $d->where('display_name', '=', "%$term%");

        $d->union($a);
        $d->union($b);
        $d->union($c);

        return $d->get();
    }
}
