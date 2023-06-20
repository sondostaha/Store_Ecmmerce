<?php

namespace App\Http\Controllers\AdminDashboard;

use Exception;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagsRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(PAGINATION_COUNT) ;

        return view('admin.tags.index',compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }
    public function store(TagsRequest $request)
    {
        try{
            DB::beginTransaction();
          
            $slug = Tag::create([
                
                'slug' => $request->slug,
            ]);

            $slug->name = $request->name ;
            $slug->save();

            DB::commit();

           return redirect()->route('admin.tags')->with('success','تم الاضافه بنجاح');

        }catch(Exception $ex)
        {
            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
    
    public function edit($id)
    {
        $tag = Tag::find($id);
        if(!$tag)
        {
            return redirect()->route('admin.tags')->with('error','هذه الماركه غير موجوده');
            
        }
        return view('admin.tags.edit',compact('tag'));
    }
    public function update(TagsRequest $request , $id)
    {
        try
        {
            DB::beginTransaction();

             $tag = Tag::find($id);

            if(!$tag)
            {
                return redirect()->route('admin.tags')->with('error','هذا الtag  غير موجوده');
                
            }

           
            $tag->update([
                'slug' => $request->slug,
            ]);

            $tag->name = $request->name ;
            $tag->save();
            DB::commit();
           return redirect()->route('admin.tags')->with('success','تم التعديل بنجاح');
        }
        catch(Exception $ex)
        {
            DB::rollBack();
            return redirect()->route('admin.tags')->with('error','حدث خطا ما');

        }
    }
    public function delete($id)
    {
        try{
            $tag = Tag::find($id);
            if(!$tag)
            {
                return redirect()->back()->with('error','هذا 5tag  غير موجود');
            }
           
            $tag->delete($id);

           return redirect()->back()->with('success','تم الحذف بنجاح');

        }catch(Exception $ex)
        {
            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
}
