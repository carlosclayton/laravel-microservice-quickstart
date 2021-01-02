<?php


namespace Tests\Traits;


use App\Models\Gender;
use Illuminate\Database\Eloquent\Model;

trait ModelValidation
{
    protected function assertModelExist(Model $model){
        $this->assertInstanceOf(Model::class, $model);
    }

    protected function assertModelFillable(Model $model, Array $array){
        $this->assertEquals($model->getFillable(), $array);
    }

    protected function assertModelNewInstance(Model $model, Array $attr){
        self::assertEquals($model->getAttributes(), $attr);
    }


}
