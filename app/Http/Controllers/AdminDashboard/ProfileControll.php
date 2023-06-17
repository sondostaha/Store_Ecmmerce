<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileControll extends Controller
{
    public function edit()
    {
        $id = Auth::user()->id ;
        $user = Admin::findOrFail($id);

        return view('admin.profile.edit',compact('user'));
    }
    public function update(ProfileRequest $request)
    {
        try

        { 
            $id = Auth::user()->id ;
            $user = Admin::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            if( $request->filled('password'))
            {
                $user->update([
                    'password' => bcrypt($request->password)
                ]);
            }
          
            return back()->with('success','تم التحديث بنجاح');
        }catch(Exception $ex)
        {
            return back()->with('error','حدث خطاء ما ');
            
        }
    }
}
