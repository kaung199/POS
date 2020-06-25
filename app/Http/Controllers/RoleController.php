<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->get();
        $permission = Permission::get();
        return view('roles.index',compact('roles', 'permission'));
    }


    public function create()
    {
        $permission = Permission::get();

        return view('roles.create',compact('permission'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required|unique:roles,name',

            'permission' => 'required',

        ]);


        $role = Role::create(['name' => $request->input('name')]);

        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')

            ->with('success','Role created successfully');
    }


    public function show($id)
    {
//
    }


    public function edit($id)
    {
        $role = Role::find($id);

        $permission = Permission::get();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)

            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')

            ->all();


        return view('roles.edit',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name' => 'required',

            'permission' => 'required',

        ]);


        $role = Role::find($id);

        $role->name = $request->input('name');

        $role->save();


        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')

            ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();

        return redirect()->route('roles.index')

            ->with('success','Role deleted successfully');
    }
}
