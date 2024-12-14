<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $connection = 'mysql-pos';
    protected $guarded = ['vendor_id'];

    protected static function newFactory()
    {
        return \Modules\Settings\Database\factories\VendorFactory::new();
    }
}
