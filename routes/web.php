<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/db-test', function () {
    try {
        $tables = DB::select('SHOW TABLES');

        return response()->json([
            'status' => 'DB CONNECTED',
            'tables_count' => count($tables),
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'DB ERROR',
            'message' => $e->getMessage(),
        ], 500);
    }
});
