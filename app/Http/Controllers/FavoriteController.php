<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FavoriteRequest;
use App\Models\User;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * Show all favorites for user (.list method)
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->user()->favorites()->with(['pics','products','materials','machines'])->get();
    }

    /**
     * Add punch to favofites with check present (.add method)
     *
     * @param  App\Http\Requests\FavoriteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FavoriteRequest $request)
    {
        $user_id = $request->user()->token()->user_id;
        $data = $request->validated();

        $isIsset = Favorite::where([['user_id', $user_id], ['punch_id', $data['punch_id']]])->first();
        if ($isIsset) {
            return ['error' => 'Штамп уже в избранном!'];
        } else {
            $result = Favorite::create([
                'user_id' => $user_id,
                'punch_id'=> $data['punch_id'],
            ]);
            return ['result' => 
                ['id' => $result->id],
            ];
        }        
    }

    /**
     * Remove punch from favorites (.delete method)
     *
     * @param  App\Http\Requests\FavoriteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoriteRequest $request)
    {
        $data = $request->validated();
        $user_id = $request->user()->token()->user_id;

        $punch = Favorite::where([['user_id', $user_id], ['punch_id', $data['punch_id']]])->first();
        if ($punch) {
            $result = $punch->delete();
        } else {
            return ['result' => (bool)$punch];
        }
        return ['result' => (bool)$result];
    }
}
