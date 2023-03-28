<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function roleView()
    {
        $data = Permission::select('group_name')->groupBy('group_name')->latest()->get();
        return view('admin.permissions.index', compact('data'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.role_has_permission.create')) {
            abort(403, 'SORRY !! You are unothorize to create permission');
        }
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|unique:users,name'
            ]);
    
            $count = count($request->name);
    
            if ($count != null) {
                for ($i=0; $i < $count; $i++) { 
                   $permission = new Permission();
                   $permission->guard_name = 'admin';
                   $permission->group_name = $request->group_name;
                   $permission->name = $request->name[$i];
                   $permission->save();
                }
                
                Alert::success('Successfully Created!!', 'successfully created permission');
                return redirect()->route('admin.role_has_permission.index');
            }
        }catch(Exception $e){
            Alert::error('SORRY !!', 'Error store permission');
            return redirect()->back();
        }
    }

    public function edit($group_name)
    {
        if (is_null($this->user) || !$this->user->can('admin.role_has_permission.edit')) {
            abort(403, 'SORRY !! You are unothorize to edit permission');
        }
        $data = Permission::where('group_name',$group_name)->get();
        return view('admin.permissions.edit', compact('data'));
    }

    public function update(Request $request, $group_name)
    {
        try{
            if($request->name == null){
                Alert::error('permission error!', 'Error Updaed permission');
                return redirect()->back();
            }else{
                $count = count($request->name);
                Permission::where('group_name', $group_name)->delete();
    
                $request->validate([
                    'name' => 'required|unique:permissions,name,'
                ]);
    
                for ($i=0; $i < $count; $i++) { 
                    $permission = new Permission();
                    $permission->guard_name = 'admin';
                    $permission->group_name = $request->group_name;
                    $permission->name = $request->name[$i];
                    $permission->save();
                }
                Alert::success('Successfully Updated!!', 'successfully Updated permission');
                return redirect()->route('admin.role_has_permission.index');
            }
        }catch(Exception $e){
            Alert::error('SORRY !!', 'Error updated permission');
            return redirect()->back();
        }
    }


    public function delete($group_name)
    {
        try{
            if (is_null($this->user) || !$this->user->can('admin.role_has_permission.delete')) {
                abort(403, 'SORRY !! You are unothorize to delete permission');
            }
            Permission::where('group_name', $group_name)->delete();
            Alert::success('Successfully Deleted!!', 'successfully deleted permission group');
            return redirect()->back();
        }catch(Exception $e){
            Alert::error('SORRY !!', 'Error Deleted permission');
            return redirect()->back();
        }
    }

}
