<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sync extends Model
{
    // 数据库'dadtabase_center'中的users表
    protected $connection = 'mysql_center';
    protected $table = "yundb_type";
}
