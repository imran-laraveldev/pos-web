<?php

namespace Modules\Reports\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PosBranch extends Model
{
    use HasFactory;

    protected $connection = 'mysql-pos';
    protected $table = 'branchs';
    protected $primaryKey = 'branch_id';
    protected $guarded = ['branch_id'];

    protected static function newFactory()
    {
        return \Modules\Reports\Database\factories\PosUserFactory::new();
    }

}
