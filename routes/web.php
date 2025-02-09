<?php
use drgham\DBStats\Http\Controllers\DBStatsController;

Route::prefix('dbstats')->group(function() {
    Route::get('table/{table}', [DBStatsController::class, 'showStatistics']);
});
