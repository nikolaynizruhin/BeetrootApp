<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

class PositionCountQuery
{
    /**
     * Call an object as a function.
     *
     * @param  int  $limit
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($limit = 6)
    {
        return DB::table('users')
            ->select('position as title', DB::raw('COUNT(*) as count'))
            ->groupBy('position')
            ->orderBy('count', 'desc')
            ->limit($limit)
            ->get();
    }
}
