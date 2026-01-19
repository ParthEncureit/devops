Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'env' => config('app.env'),
    ]);
});