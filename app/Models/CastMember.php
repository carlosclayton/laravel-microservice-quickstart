<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CastMember extends Model
{
    use SoftDeletes, Uuid;
    public $incrementing = false;
    protected $keyType = "string";
    protected $dates = ['deleted_at'];

    const TYPE_ACTOR = 0;
    const TYPE_DIRECTOR = 1;

    protected $fillable = ['name', 'description', 'type', 'description'];

}
