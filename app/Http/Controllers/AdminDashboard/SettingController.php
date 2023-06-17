<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Setting;
use Exception;
use Faker\Extension\Extension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function shipping($type)
    {
        if($type == 'free')
        {
            $shippingMethod = Setting::where('key','free_shipping_label')->first();
        }elseif($type == 'local')
        {
            $shippingMethod = Setting::where('key','local_label')->first();
        }elseif($type == 'outer')
        {
            $shippingMethod = Setting::where('key','outer_label')->first();
        }

        return view('admin.setting.edit',compact('shippingMethod'));
    }

    public function shippingUpdate(ShippingRequest $request , $id)
    {
        try{

            DB::beginTransaction();
            $shipping  = Setting::findOrfail($id);
        
            $shipping->update([
                'plain_value' => $request->plain_value,
            ]);
    
            $shipping->value = $request->value ;
    
            $shipping->save();
            DB::commit();
            return back()->with(['success'=> 'تم التعديل بنجاح']);
        }catch(Exception $ex){

            DB::rollBack();
            return back()->with(['error'=> 'هناك خطاء ما']);

        }
        
    }
}
