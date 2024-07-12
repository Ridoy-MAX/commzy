<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function myFavourite(Request $request)
    {
        try {
        $userRoles = Auth::user()->roles->pluck('name')->toArray();

        // Check if the user has the "super-admin" role
        if (in_array('super-admin', $userRoles)) {
            $favourites = Favourite::latest()->paginate(15);
        }else{
            $favourites = Favourite::where('user_id', Auth::id())->paginate(15);
        }
        return view('favourite.index', [
            'favourites' => $favourites,
        ]);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
