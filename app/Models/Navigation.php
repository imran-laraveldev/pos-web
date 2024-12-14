<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','parent_id','type','dynamic_form_id','sort_id'];

    function children()
    {
        return $this->hasMany(Navigation::class, 'parent_id', 'id')->orderBy('sort_id');
    }
}
