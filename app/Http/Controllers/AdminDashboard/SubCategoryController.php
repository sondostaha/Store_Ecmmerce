<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\SubCategoryRequest;
use Exception;
use Symfony\Component\Process\ExecutableFinder;

class SubCategoryController extends Controller
{
    public function index(Category $category)
    {
        $subcategories = $category->child()->get();

        return view('admin.subcategories.index',compact('subcategories'));
    }
    public function create(Category $category)
    {
        $categories = $category->parent()->get();   
        return view('admin.subcategories.create',compact('categories'));
    }

    public function store(SubCategoryRequest $request)
    {
        try{
            $category = Category::create([
                'parent_id' => $request->parent_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'is_active' => $request->is_active
            ]);
            return redirect()->route('admin.subcategories')->with('success','تم الاضافه بنجاح');

        }catch(Exception $ex)
        {
            return redirect()->route('admin.subcategories')->with('error','حدث خطا ما');
        }
    }
    public function edit($id)
    {
        try {
            $category = Category::find($id);
            $categories = Category::parent()->get();
            if(!$category)
            {
                return redirect()->route('admin.categories')->with('error','هذا القسم غير موجود');
                
            }
            return view('admin.subcategories.edit',compact('category','categories'));
        }catch(Exception $ex)
        {
            return redirect()->route('admin.categories')->with('error','حدث خطا ما');

        }
       
    }

    public function update(SubCategoryRequest $request , $id)
    {
        try{
            $subcategory = Category::find($id);
           
            if(!$subcategory)
            {
                return redirect()->route('admin.subcategories')->with('error','هذا القسم غير موجود');
                
            }
            if($request->has('is_active'))
            {
                $request->request->add(['is_active'=> 1]);
            }else{
                $request->request->add(['is_active'=> 0]);

            }
            $subcategory->update([
                'parent_id' => $request->parent_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'is_active' => $request->is_active
            ]);

            $subcategory->name = $request->name ;
            $subcategory->save();

            return redirect()->route('admin.subcategories')->with('success','تم التعديل بنجاح');

        }catch(Exception $ex)
        {
            return redirect()->route('admin.categories')->with('error','حدث خطا ما');
        }
    }

    public function delete($id)
    {
        try{
            $subcategory = Category::find($id);
           
            if(!$subcategory)
            {
                return redirect()->route('admin.subcategories')->with('error','هذا القسم غير موجود');
                
            } 
            $subcategory->delete();
            return redirect()->route('admin.subcategories')->with('success','تم الحذف بنجاح');

        }
        catch(Exception $ex)
        {
            return redirect()->route('admin.categories')->with('error','حدث خطا ما');

        }
    }
    
}
