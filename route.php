Route::get('migrate', function () {
    \Artisan::call('migrate');
});

Route::get('config_cache', function () {
    \Artisan::call('config:cache');
});

Route::get('cache_clear', function () {
    \Artisan::call('cache:clear');
});
