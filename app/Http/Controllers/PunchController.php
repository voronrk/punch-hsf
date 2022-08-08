<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PunchRequest;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PunchRequest $request)
    {
        $validatedRequest = $request->validated();

        $punch = Punch::create([
            'name' => $validatedRequest['title'],
            'ordernum' => $validatedRequest->input('ordernum'),
            'year' => $validatedRequest->input('year'),
            'size_length' => $validatedRequest['size-length'],
            'size_width' => $validatedRequest['size-width'],
            'size_height' => $validatedRequest->input('size-height'),
            'knife_size_length' => $validatedRequest->input('knife-size-length'),
            'knife_size_width' => $validatedRequest->input('knife-size-width'),
        ]);

        $products = Product::find($request->products);
        $punch->products()->attach($products);

        $materials = Material::find($request->materials);
        $punch->materials()->attach($materials);

        $machines = Machine::find($request->machines);
        $punch->machines()->attach($machines);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return Punch::with(['pics','products','materials','machines'])->where('id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}
