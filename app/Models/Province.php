<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Province extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable,SoftDeletes;

    protected $table = 'provinces';

}