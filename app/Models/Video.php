<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes, Uuid;
    const RATING_LIST = ['L', '10', '12', '14', '16', '18'];

    public $incrementing = false;
    protected $keyType = "string";
    protected $dates = ['deleted_at'];
    protected $casts = [
      'id' => 'string',
      'opened' => 'boolean',
      'year_launched' => 'integer',
      'duration' => 'integer'

    ];
    protected $fillable = ['title', 'description', 'year_launched', 'opened', 'duration', 'rating'];

    public function categories(){
        return  $this->belongsToMany(Category::class);
    }
}
