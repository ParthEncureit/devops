
<?php

use App\Http\Controllers\HealthController;

Route::get("/", function () {
    return "Laravel CI/CD Test Project";
});

Route::get("/health", [HealthController::class, "index"]);
