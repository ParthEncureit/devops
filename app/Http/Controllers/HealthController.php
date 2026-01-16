
<?php
namespace App\Http\Controllers;

class HealthController
{
    public function index()
    {
        return response()->json([
            "status" => "ok",
            "env" => env("APP_ENV")
        ]);
    }
}
