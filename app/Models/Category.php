<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, Uuid;
    public $incrementing = false;
    protected $keyType = "string";
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'description', 'is_active'];

}
