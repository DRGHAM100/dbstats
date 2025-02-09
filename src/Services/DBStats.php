<?php
namespace drgham\DBStats\Services;

use Illuminate\Support\Facades\DB;

class DBStats
{
    public function getTableStatistics(string $table): array
    {
        $tableInfo = DB::select("SHOW TABLE STATUS LIKE ?", [$table]);

        return [
            'name' => $tableInfo[0]->Name,
            'rows' => $tableInfo[0]->Rows,
            'data_length' => $tableInfo[0]->Data_length,
            'index_length' => $tableInfo[0]->Index_length,
            'data_free' => $tableInfo[0]->Data_free,
            'create_time' => $tableInfo[0]->Create_time,
        ];
    }

    public function getTableColumns(string $table): array
    {
        return DB::select("SHOW COLUMNS FROM {$table}");
    }

    // Performance Monitoring (Query Log)
    public function getQueryPerformance(): array
    {
        DB::enableQueryLog();

        // Example of a query to monitor performance
        DB::table('users')->get();

        $queries = DB::getQueryLog();
        
        return [
            'queries' => $queries,
            'execution_time' => microtime(true) - LARAVEL_START
        ];
    }
}
