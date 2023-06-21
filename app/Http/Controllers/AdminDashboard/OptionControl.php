<?php

namespace App\Http\Controllers\AdminDashboard;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OptionControl extends Controller
{
    public function index()
    {
        $options = Option::paginate(PAGINATION_COUNT) ;

        return view('admin.options.index',compact('options'));
    }

    public function create()
    {
        $data = [];
        $data['products'] = Product::all();
        $data['attributes'] = Attribute::all();

        return view('admin.options.create',$data);
    }
    public function store(OptionRequest $request)
    {
        try{
            DB::beginTransaction();
          
            $oprion = Option::create([
                'product_id' => $request->product_id,
                'attribute_id' => $request->attribute_id,
                'price' => $request->price,
                'name' => $request->name
            ]);



            DB::commit();

           return redirect()->route('admin.options')->with('success','تم الاضافه بنجاح');

        }catch(Exception $ex)
        {
            DB::rollBack();
            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
    
    public function edit($id)
    {
        $data =[];
        $data['option'] = Option::find($id);

        if(!$data['option'])
        {
            return redirect()->route('admin.options')->with('error','هذا الحقل غير موجود');
        }
        $data['products'] = Product::all();
        $data['attributes'] = Attribute::all();

     
        return view('admin.options.edit',$data);
    }
    public function update(OptionRequest $request , $id)
    {
        try
        {
            DB::beginTransaction();
             $option = Option::find($id);

            if(!$option)
            {
                return redirect()->route('admin.options')->with('error','هذا الحقل غير موجود');
                
            }

           
            $option->update([
                'product_id' => $request->product_id,
                'attribute_id' => $request->attribute_id,
                'price' => $request->price,
                'name' => $request->name
            ]);

           
            DB::commit();
           return redirect()->route('admin.options')->with('success','تم التعديل بنجاح');
        }
        catch(Exception $ex)
        {
            DB::rollBack();
            return redirect()->route('admin.options')->with('error','حدث خطا ما');

        }
    }
    public function delete($id)
    {
        try{
            $option = Option::find($id);
            if(!$option)
            {
                return redirect()->back()->with('error','هذا الحقل غير موجود');
            }
           
            $option->delete($id);

           return redirect()->back()->with('success','تم الحذف بنجاح');

        }catch(Exception $ex)
        {
            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
}