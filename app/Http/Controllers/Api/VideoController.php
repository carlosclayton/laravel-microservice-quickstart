<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BasicCrudController;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VideoController extends BasicCrudController
{
    /**
     * @return Video
     */
    protected function model()
    {
        return Video::class;
    }

    /**
     * @return string[]
     */
    protected function rulesStore()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'year_launched' => 'required|',
            'opened' => 'boolean',
            'duration' => 'required|integer',
            'rating' => 'required|in:'. implode(',', Video::RATING_LIST) ,
            'categories_id' => 'required|array|exists:categories,id'

        ];

    }

    /**
     * @return string[]
     */
    protected function rulesUpdate()
    {

        return [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'year_launched' => 'required|',
            'opened' => 'boolean',
            'duration' => 'required|integer',
            'rating' => 'required|in:'. implode(',', Video::RATING_LIST) ,
            'categories_id' => 'required|array|exists:categories,id'

        ];
    }

    public function store(Request $request){
        $validate = $this->validate($request, $this->rulesStore());

        /** @var Video $video */
        $video = $this->model()::create($validate);
        $video->categories()->sync($request->get('categories_id'));
        $video->refresh();
        return $video;
    }

    public function update(Request $request, $id){
        $validate = $this->validate($request, $this->rulesStore());


        /** @var Video $video */
        $video = $this->model()::findOrFail($id);
        $video->update($request->except('categories_id'));
        $video->categories()->sync($request->get('categories_id'));
        $video->refresh();
        return $video;
    }
}
