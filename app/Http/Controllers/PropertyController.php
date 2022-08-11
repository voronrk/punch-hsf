<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PropertyRequest;
use Illuminate\Support\Facades\Cache;

abstract class PropertyController extends Controller
{

    protected $model;
    protected $tableName;

    /**
     * Return list of properties for filter (.list method)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cache::store('file')->get($this->tableName, function () {
            $data = $this->model::select('id', 'value')->get();
            Cache::store('file')->put($this->tableName, $data);
            return ['result' => $data];
        });
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
        $result = $this->model::create([
            'value'=> $data['value']
        ]);
        if ($result) Cache::forget($this->tableName);
        return ['result' => 
            ['id' => $result->id],
        ];
    }

    /**
     * Return one property by id (.get method)
     *
     * @param  App\Http\Requests\PropertyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyRequest $request)
    {
        $data = $request->validated();
        $result = Cache::store('file')->get($this->tableName, function () {
            $data = $this->model::select('id', 'value')->get();
            Cache::store('file')->put($this->tableName, $data);
            return $data;
        })->firstWhere('id', $data['id']);
        return ['result' => $result];
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
        $result = $this->model::where('id', $data['id'])
                        ->update(['value' => $data['value']]);
        if ($result) Cache::forget($this->tableName);
        return ['result' => (bool)$result];
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
        $property = $this->model::find($data['id']);
        if ($property) {
            $result = $property->delete();
        } else {
            return ['result' => (bool)$property];    
        }
        if ($result) Cache::forget($this->tableName);
        return ['result' => (bool)$result];
    }
}
