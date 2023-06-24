<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [] ;
        $data['sliders'] = Slider::get(['photo']);
        return view('front.home',$data);
    }
}
