<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class PropertyController extends Controller
{

    protected $model;

    /**
     * Return list of properties for filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model::select('id', 'value')->get();
    }

    /**
     * Add new property to database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->model::create([
            'value'=> $request->value
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->model::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->model::where('id', $request->id)
                    ->update(['value' => $request->value]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->model::where('id', $request->id)->delete();
    }
}
