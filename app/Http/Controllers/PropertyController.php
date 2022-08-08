<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PropertyRequest;

abstract class PropertyController extends Controller
{

    protected $model;

    /**
     * Return list of properties for filter (.list method)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model::select('id', 'value')->get();
    }

    /**
     * Add new property to database (.add method)
     *
     * @param  App\Http\Requests\PropertyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $data = $request->validated();
        return $this->model::create([
            'value'=> $data['value']
        ]);
    }

    /**
     * Display one property by id (.get method)
     *
     * @param  App\Http\Requests\PropertyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyRequest $request)
    {
        $data = $request->validated();
        return $this->model::findOrFail($data['id']);
    }

    /**
     * Update property (.update method)
     *
     * @param  App\Http\Requests\PropertyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request)
    {
        $data = $request->validated();
        return $this->model::where('id', $data['id'])
                    ->update(['value' => $data['value']]);
    }

    /**
     * Remove property (.delete method)
     *
     * @param  App\Http\Requests\PropertyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyRequest $request)
    {
        $data = $request->validated();
        $property = $this->model::findOrFail($data['id']);
        return $property->delete();
    }
}
