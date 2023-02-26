<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public $user;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.role.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }

        $roles = Role::all();
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('admin.roles.create', compact('all_permissions', 'permission_groups','roles'));
    }

    public function store(Request $request)
    {
         if (is_null($this->user) || !$this->user->can('admin.role.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }

        $request->validate([
            'name'=>'required|max:20|unique:roles'
        ],
        [
            'name.required'=>'Please give a new role',
            'name.max'=>'Please input at last 20 char',
            'name.unique'=>'Please give unique name'
        ]);


        $role = Role::create(['guard_name' => 'admin','name'=>$request->name]);
        $permissions = $request->input('permissions');

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        Alert::success('Role Create Successfully!', 'Thanks for create a new role');

        return redirect()->route('admin.role.index');
    }

    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.role.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }
        
        $role = Role::findById($id, 'admin');
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('admin.roles.edit', compact('all_permissions', 'permission_groups', 'role'));
    }

    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.role.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }

        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        $role = Role::findById($id, 'admin');
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }
        Alert::success('Role Create Successfully!', 'Thanks for create a new role');

        return redirect()->route('admin.role.index');
    }

    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.role.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }
        
        $role = Role::findById($id, 'admin');
        if (!is_null($role)) {
            $role->delete();
        }
        Alert::success('Role Create Successfully!', 'Thanks for create a new role');

        return redirect()->back();
    }
}
