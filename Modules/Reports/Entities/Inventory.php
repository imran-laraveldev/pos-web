<?php

namespace Modules\Reports\Entities;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Settings\Entities\Category;
use Modules\Settings\Entities\Vendor;

class Inventory extends Model
{
    use HasFactory;

    protected $connection = 'mysql-pos';
    protected $table = 'inventory';
    protected $guarded = ['inventory_id'];

    protected static function newFactory()
    {
        return \Modules\Reports\Database\factories\InventoryFactory::new();
    }

    function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }

    function department()
    {
        return $this->belongsTo(Category::class, 'department_id', 'department_id');
    }
}
