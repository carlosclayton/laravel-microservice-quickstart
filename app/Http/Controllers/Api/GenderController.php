<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BasicCrudController;
use App\Http\Controllers\Controller;
use App\Models\Gender;

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
            'description' => 'nullable'
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
            'description' => 'nullable'
        ];
    }
}
