<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    DB::table('visits')->insert([
        'page' => 'home',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return "✅ Laravel running with shared .env & DB connected";
});
