<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PunchRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Punch;
use App\Models\Pic;
use App\Models\Product;
use App\Models\Material;
use App\Models\Machine;

class PunchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Punch::with(['pics','products','materials','machines'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PunchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PunchRequest $request)
    {
        $validatedRequest = $request->validated();

        // echo "<pre>";
        // echo print_r($request->all(),true);
        // echo print_r($validatedRequest,true);
        // echo "</pre>";
        // die();

        $punch = Punch::create([
            'name' => $validatedRequest['title'],
            'ordernum' => $validatedRequest['ordernum'],
            'year' => $validatedRequest['year'],
            'size_length' => $validatedRequest['size-length'],
            'size_width' => $validatedRequest['size-width'],
            'size_height' => $validatedRequest['size-height'],
            'knife_size_length' => $validatedRequest['knife-size-length'],
            'knife_size_width' => $validatedRequest['knife-size-width'],
        ]);

        // echo "<pre>";
        // echo print_r($validatedRequest->products,true);
        // echo "</pre>";
        // die();
        $products = Product::find($validatedRequest['products']);
        if ($products) {
            $punch->products()->attach($products);
        };

        $materials = Material::find($validatedRequest['materials']);
        if ($materials) {
            $punch->materials()->attach($materials);
        };

        $machines = Machine::find($validatedRequest['machines']);
        if ($machines) {
            $punch->machines()->attach($machines);
        };

        foreach($request->pics as $pic) {
            $file = $pic;
            $upload_folder = 'public/img';
            $path = Storage::putFile($upload_folder, $file);
            $punch->pics()->create([
                'value' => $path
            ]);
        };

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Http\Requests\PunchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function show(PunchRequest $request)
    {
        $data = $request->validated();
        return Punch::with(['pics','products','materials','machines'])->where('id', $data['id'])->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PunchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PunchRequest $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\PunchRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PunchRequest $request)
    {
        $data = $request->validated();
        $punch = Punch::findOrFail($data['id']);
        return $punch->delete();
    }
}
