<?php

namespace App\Http\Controllers\AdminDashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;

class SliderController extends Controller
{
    public function addImage()
    {
        $images = Slider::get(['photo']);

        return view('admin.slider.images.create',compact('images'));
    }


   

    public function saveSliderImages(Request $request)
    {
       
        if($request->hasFile('dzfile'))
        {
            $file = $request->file('dzfile');
            $file_name = getImage('sliders',$request->dzfile);
        }   
        return response()->json([
            'name' => $file_name ,
            'origine_name' => $file->getClientOriginalName(),
        ]);
    }
    public function saveSliderImagesDb(SliderRequest $request)
    {
        try{
            DB::beginTransaction();
            
            if($request->has('document') && count($request->document) > 0)
            {
                foreach($request->document as $photo)
                {
                    Slider::create([
                        'photo' => $photo
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.create.slider')->with('success','تم الاضافه بنجاح');

        }catch(Exception $ex)
        {
            DB::rollBack();

            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
}