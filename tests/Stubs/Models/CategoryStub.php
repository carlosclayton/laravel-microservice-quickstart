<?php


namespace Tests\Stubs\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class CategoryStub extends Model
{
    protected $table = "categories_stubs";
    protected $fillable = ["name", "description", "is_active"];

    public static function createTable(){
        \Schema::create('categories_stubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public static function droptable(){
        \Schema::dropIfExists('categories_stubs');
    }

}
