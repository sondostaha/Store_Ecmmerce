<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $products = auth()->user()->wishlist()->latest()->get();
        return view('front.wishlist',compact('products'));
    }
    public function store()
    {
        $user = Auth::user();
        // dd(request('productId'));
        if(! $user->wishlistHas(request('productId')))
        {
            $user->wishlist()->attach(request('productId'));
        }
    }

    public function delete()
    {
        auth()->user()->wishlist()->detach(request('productId'));
    }
}
