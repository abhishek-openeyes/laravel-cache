<?php

use Illuminate\Support\Facades\Route;
use theopeneyes\Caches\CachePackage;
use theopeneyes\emailtemplate\Models\CacheLog;

Route::prefix('cache-log-clear')->group(function () {
    
    Route::get('/all', function () {
        CacheLog::truncate();
        return response()->json('All Cache Log Deleted Successfully' , '200');
    });

    Route::get('/daily', function () {
        CacheLog::where('created_at', '<', \Carbon\Carbon::now()->subDay())->delete();
        return response()->json('One Day Before Cache Log Deleted Successfully' , '200');
    }); 

    Route::get('/week', function () {
        CacheLog::where('created_at', '<', \Carbon\Carbon::now()->subWeek())->delete();
        return response()->json('One Week Before Cache Log Deleted Successfully' , '200');
    });  

    Route::get('/month', function () {
        CacheLog::where('created_at', '<', \Carbon\Carbon::now()->subMonth())->delete();
        return response()->json('One Month Before Cache Log Deleted Successfully' , '200');
    });    
    
});

