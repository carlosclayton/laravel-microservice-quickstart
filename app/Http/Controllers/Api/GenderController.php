<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BasicCrudController;
use App\Http\Controllers\Controller;
use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends BasicCrudController
{
    /**
     * @return Gender
     */
    protected function model()
    {
        return Gender::class;
    }

    /**
     * @return string[]
     */
    protected function rulesStore()
    {
        return [
            'name' => 'required|max:255',
            'is_active' => 'boolean',
            'description' => 'nullable',
            'categories_id' => 'required|array|exists:categories,id'
        ];
    }

    /**
     * @return string[]
     */
    protected function rulesUpdate()
    {
        return [
            'name' => 'required|max:255',
            'is_active' => 'boolean',
            'description' => 'nullable',
            'categories_id' => 'required|array|exists:categories,id'
        ];
    }


    public function store(Request $request){
        $validate = $this->validate($request, $this->rulesStore());

        /** @var Gender $gender */
        $gender = $this->model()::create($validate);
        $gender->categories()->sync($request->get('categories_id'));
        $gender->refresh();
        return $gender;
    }


    public function update(Request $request, $id){
        $validate = $this->validate($request, $this->rulesStore());


        /** @var Gender $gender */
        $gender = $this->model()::findOrFail($id);
        $gender->update($request->except('categories_id'));
        $gender->categories()->sync($request->get('categories_id'));
        $gender->refresh();
        return $gender;
    }

}
