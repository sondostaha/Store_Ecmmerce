<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesRequest;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('admin.roles.index',compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }
    public function store(RolesRequest $request)
    {
        try
        {
            // dd($request->permissions);
            Role::create([
                'name' => $request->name,
                'permissions' => $request->permissions
            ]);

            return redirect()->route('admin.roles')->with('success','role added successfully');
        }
        catch(Exception $ex)
        {
            return redirect()->back()->with('error','somthing goes wrong please try again');

        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit',compact('role'));
    }

    public function update(RolesRequest $request ,$id)
    {
        try
        {
            $role = Role::findOrFail($id);
            $role->update([
                'name' => $request->name,
                'permissions' => $request->permissions
            ]);

            return redirect()->route('admin.roles')->with('success','role added successfully');

        }
        catch(Exception $ex)
        {
            return redirect()->back()->with('error','somthing goes wrong please try again');
        }
    }
   
}
