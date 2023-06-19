<?php

namespace App\Http\Controllers\AdminDashboard;

use Exception;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brandsrequest;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(PAGINATION_COUNT) ;

        return view('admin.brands.index',compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }
    public function store(BrandsRequest $request)
    {
        try{
            DB::beginTransaction();
            if(!$request->has('is_active'))
            {
                $request->request->add(['is_active' => 0]);
            }else
            {
                $request->request->add(['is_active' => 1]);

            }
            if($request->hasFile('photo'))
            {
                $file_name = getImage('brands',$request->photo);
            }
            // dd($request->all());
            $brand = Brand::create([
                
                'is_active' => $request->is_active,
                'photo' => $file_name,
            ]);

            $brand->name = $request->name ;
            $brand->save();
            DB::commit();
           return redirect()->route('admin.brands')->with('success','تم الاضافه بنجاح');

        }catch(Exception $ex)
        {
            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
    
    public function edit($id)
    {
        $brand = Brand::find($id);
        if(!$brand)
        {
            return redirect()->route('admin.brands')->with('error','هذه الماركه غير موجوده');
            
        }
        return view('admin.brands.edit',compact('brand'));
    }
    public function update(BrandsRequest $request , $id)
    {
        // try
        // {
            DB::beginTransaction();

             $brand = Brand::find($id);

            if(!$brand)
            {
                return redirect()->route('admin.brands')->with('error','هذه الماركه غير موجوده');
                
            }

            if(!$request->has('is_active'))
            {
                $request->request->add(['is_active' => 0]);
            }else
            {
                $request->request->add(['is_active' => 1]);

            }
            if($request->hasFile('photo'))
            {
                if($brand->photo)
                {
                    unlink(public_path('assets/images/brands/'.$brand->photo));
                }

                $file_name = getImage('brands',$request->photo);
            }

            
            // dd($request->slug);
            $brand->update([
                'is_active' => $request->is_active,
                'photo' => $file_name
            ]);

            // $brand->name = $request->name ;
            // $brand->save();
            DB::commit();
           return redirect()->route('admin.brands')->with('success','تم التعديل بنجاح');
        // }
        // catch(Exception $ex)
        // {
        //     DB::rollBack();
        //     return redirect()->route('admin.brands')->with('error','حدث خطا ما');

        // }
    }
    public function delete($id)
    {
        try{
            $brand = Brand::find($id);
            if(!$brand)
            {
                return redirect()->back()->with('error','هذا القسم غير موجود');
            }
            if($brand->photo)
            {
                unlink(public_path('assets/images/brands/'.$brand->photo));
            }
            $brand->delete($id);

           return redirect()->back()->with('success','تم الحذف بنجاح');

        }catch(Exception $ex)
        {
            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
}
