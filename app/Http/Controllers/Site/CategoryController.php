<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function productBySlug($slug)
    {
        $data = [];
        $data['category'] = Category::where('slug',$slug)->first();
        if($data['category'])
        
            $data['products'] = $data['category']->products;
            // return Product::images()->phot->get() ;
        return view('front.products',$data); 
    }
}
