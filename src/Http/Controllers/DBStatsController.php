<?php
namespace drgham\DBStats\Http\Controllers;

use YourVendor\DBStats\Services\DBStats;
use Illuminate\Http\Request;

class DBStatsController extends Controller
{
    protected $dbStats;

    public function __construct(DBStats $dbStats)
    {
        $this->dbStats = $dbStats;
    }

    public function showStatistics(string $table)
    {
        $tableStats = $this->dbStats->getTableStatistics($table);
        $tableColumns = $this->dbStats->getTableColumns($table);

        return view('dbstats::statistics', compact('tableStats', 'tableColumns'));
    }
}
