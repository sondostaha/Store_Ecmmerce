<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequeest;
use App\Models\Attribute;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::paginate(PAGINATION_COUNT);
        return view('admin.attribute.index',compact('attributes'));
    }
    public function create()
    {
        return view('admin.attribute.create');
    }
    public function store(AttributeRequeest $request)
    {
        try{
            DB::beginTransaction();
            Attribute::create([
                'name'=>$request->name
            ]);
            DB::commit();
            return redirect()->route('admin.attribute')->with('success','تم الاضافه بنجاح');
        }
        catch(Exception $ex)
        {
            DB::rollBack();
            return redirect()->route('admin.attribute')->with('error','حدث خطا ما');

        }
    }

    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('admin.attribute.edit',compact('attribute'));
    }
    public function update(AttributeRequeest $request ,$id)
    {
        try{
            DB::beginTransaction();
            
            $attribute = Attribute::findOrFail($id);

            $attribute->update([
                'name'=>$request->name
            ]);
            DB::commit();
            return redirect()->route('admin.attribute')->with('success','تم التعديل بنجاح');
        }
        catch(Exception $ex)
        {
            DB::rollBack();
            return redirect()->route('admin.attribute')->with('error','حدث خطا ما');

        }
    }
    public function delete($id)
    {
        try{

            $attribute = Attribute::findOrFail($id);
            $attribute->delete();
            
            return redirect()->route('admin.attribute')->with('success','تم الحذف بنجاح');
        }
        catch(Exception $ex)
        {
            return redirect()->route('admin.attribute')->with('error','حدث خطا ما');

        }
    }
}
