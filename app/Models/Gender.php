<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model
{
    use SoftDeletes, Uuid;
    public $incrementing = false;
    protected $keyType = "string";
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'description', 'is_active'];

    public function categories(){
        return  $this->belongsToMany(Category::class);
    }

}
