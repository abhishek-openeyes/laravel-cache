<?php
namespace TheOpenEyes\Caches;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use theopeneyes\emailtemplate\Models\CacheLog;

class CachePackage
{
    
    public static function get($name,$cacheTime = 84600){
        $cacheData = (object) config('constants.CACHE.'.$name);
        if (!Cache::store(env('CACHE_DRIVER'))->get($cacheData->file_name)) {
            $databaseArray = DB::table($cacheData->tbl_name)->get()->toArray();
            Cache::store(env('CACHE_DRIVER'))->put($cacheData->file_name, $databaseArray,$cacheTime);
            CachePackage::cacheLog('constants.CACHE.'.$name,$databaseArray);
            $cacheArray = Cache::store(env('CACHE_DRIVER'))->get($cacheData->file_name);
        }else{
            $cacheArray = Cache::store(env('CACHE_DRIVER'))->get($cacheData->file_name);
        }

        return $cacheArray ;
    }

    public static function getWithArray($name,$cacheArray,$cacheTime = 84600){
        $cacheData = (object) config('constants.CACHE.'.$name);
        if (!Cache::store(env('CACHE_DRIVER'))->get($name)) {
            Cache::store(env('CACHE_DRIVER'))->put($name, $cacheArray,$cacheTime);
             CachePackage::cacheLog('constants.CACHE.'.$name,$cacheArray);
            $cacheArray = Cache::store(env('CACHE_DRIVER'))->get($cacheData->file_name);
        }else{
            $cacheArray = Cache::store(env('CACHE_DRIVER'))->get($name);
        }
        return $cacheArray ;
    }

    public static function getWithSearch($name,$searchKey,$keyValue,$cacheTime = 84600){
        $cacheData = (object) config('constants.CACHE.'.$name);

        if (!Cache::store(env('CACHE_DRIVER'))->get($cacheData->file_name)) {
            $databaseArray = DB::table($cacheData->tbl_name)->get()->toArray();
            Cache::store(env('CACHE_DRIVER'))->put($cacheData->file_name, $databaseArray,$cacheTime);
            CachePackage::cacheLog('constants.CACHE.'.$name,$databaseArray);
            $cacheArray = Cache::store(env('CACHE_DRIVER'))->get($cacheData->file_name);
        }else{
            $cacheArray = Cache::store(env('CACHE_DRIVER'))->get($cacheData->file_name);
        }

        return collect($cacheArray)->where($searchKey,$keyValue)->values();
       
    }

    public static function set($constantName, $expireTime = null){
       $cacheData = (object) config('constants.CACHE.'.$constantName);
       
        if (!Cache::store(env('CACHE_DRIVER'))->get($cacheData->file_name)) {
            $cacheArray = DB::table($cacheData->tbl_name)->get()->toArray();
            $cacheData = Cache::store(env('CACHE_DRIVER'))->put($cacheData->file_name, $cacheArray, $expireTime == null ? 84600 : $expireTime);
            CachePackage::cacheLog('constants.CACHE.'.$constantName,$cacheArray);
            return true;
        }else{
           return false;
        }
    }

    public static function delete($cacheName){
        if (is_array($cacheName)) {
            foreach ($cacheName as $data) {
                $cacheData = (object) config('constants.CACHE.'.$data);
                if (Cache::store(env('CACHE_DRIVER'))->get($cacheData->file_name)) {
                    Cache::forget($cacheData->file_name);
                }
            }
            return true;
        } else {
            $cacheData = (object) config('constants.CACHE.'.$cacheName);
            if (Cache::store(env('CACHE_DRIVER'))->get($cacheData->file_name)) {
                Cache::forget($cacheData->file_name);
                return true;
            }
        }
        return false;
    }

    public static function deleteAll(){
        Cache::flush();
        return true;
    }


    public static function cacheLog($name, $details)
    {
        if (env('CACHE_LOG') == true) {
            CacheLog::create([
                'name' => $name,
                'details' => $details
            ]);
        }
        return true;
    }
}