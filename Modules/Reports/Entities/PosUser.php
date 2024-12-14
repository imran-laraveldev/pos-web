<?php

namespace Modules\Reports\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PosUser extends Model
{
    use HasFactory;

    protected $connection = 'mysql-pos';
    protected $table = 'users';
//    protected $primaryKey = 'user_id';
//    protected $guarded = ['user_id'];

}
