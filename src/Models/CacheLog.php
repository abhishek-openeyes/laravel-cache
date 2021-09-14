<?php

namespace theopeneyes\emailtemplate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CacheLog extends Model
{
    use HasFactory;
    protected $table = "tbl_cache_logs";
    protected $fillable = [
        'name', 'details', 'created_at' ,'updated_at'
    ];
}
