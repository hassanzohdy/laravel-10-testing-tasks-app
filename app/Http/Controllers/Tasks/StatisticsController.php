<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Statistics;

class StatisticsController extends Controller
{
    /**
     * List tasks.
     */
    public function index()
    {
        // find top 10 users with the most tasks
        $statistics = Statistics::top();

        return view('tasks.statistics', [
            'statistics' => $statistics,
        ]);
    }
}
