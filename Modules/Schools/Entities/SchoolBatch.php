<?php

namespace Modules\Schools\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolBatch extends Model
{
    use HasFactory;

    protected $connection = 'mysql-fast';
    protected $table = 'batches';
    protected $primaryKey = 'batch_id';
    protected $guarded = ['batch_id'];
    protected $fillable = ['batch_id','batch_name'];

    protected static function newFactory()
    {
        return \Modules\Schools\Database\factories\SchoolBatchFactory::new();
    }
}
