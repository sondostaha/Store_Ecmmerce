<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   public function index()
   {
        $users = Admin::latest()->where('id', '<>',Auth::id())->get();
        return view('admin.users.index',compact('users')); 
   }
   public function create()
   {
        $roles = Role::get(); 
        return view('admin.users.create',compact('roles'));
   }
   public function store(UserRequest $userRequest)
   {
        try
        {
            Admin::create([
                'name' => $userRequest->name,
                'email' => $userRequest->email,
                'password' => bcrypt($userRequest->password),
                'role_id' => $userRequest->role_id
            ]);
            
            return redirect()->route('admin.user')->with('success','user added successfully');

        }
        catch(Exception $ex)
        {
            return redirect()->back()->with('error','somthing goes wrong please try again');

        }
   }
}
