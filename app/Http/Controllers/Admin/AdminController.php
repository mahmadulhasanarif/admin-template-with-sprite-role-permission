<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Exception;
use Image;

class AdminController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    function dashboard()
    {
        $user = request()->user();
        return view('admin.dashboard', compact('user'));
    }
    
    public function index()
    {
        $roles = Role::all();
        $admin = request()->user();
        $admins= Admin::latest()->get();
        return view('admin.admins.index', compact('admin', 'admins', 'roles'));
    }
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.user.create')) {
            abort(403, "SORRY !! You are not authorize to create admin");
        }
        $roles =Role::all();
        $admin = request()->user();
        $state = State::all();
        return view('admin.admins.create', compact('admin', 'state', 'roles'));
    }
    
    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                'name'=>'required|unique:users,name',
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:8|confirmed'
            ]);
    
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->address = $request->address;
            $admin->state_id = $request->state_id;
            $admin->zip = $request->zip;
            $admin->status = $request->status;
            $admin->password = bcrypt($request->password);
            
            if ($request->file('image')) {
                $image = $request->file('image');
                $name = uniqid().'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(150,120)->save('images/admins/'.$name);
                $imgReq = "images/admins/".$name;
                $admin->image = $imgReq;
            }

            $admin->save();
            

            if($request->roles){
                $admin->assignRole($request->roles);
            }
            Alert::success('Profile created Successfully!', 'thanks for create new profile');
            return redirect()->route('admin.user.index');
        }catch(Exception $e){
            Alert::error('SORRY !!', 'Admin Create Failed');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('admin.user.delete')){
            abort(403, 'Sorry !! You Are Unothoraize to edit admin');
        }
        $roles  = Role::all();
        $admin = Admin::findOrFail($id);
        $state = State::all();
        return view('admin.admins.edit', compact('admin', 'state', 'roles'));
    }

    public function update(Request $request, $id)
    {
        try{
            $admin = Admin::find($id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->address = $request->address;
            $admin->state_id = $request->state_id;
            $admin->zip = $request->zip;
            if ($request->file('image')) {
                $old_img = $request->old_image;
                if($old_img == true){
                    @unlink($old_img);
                }

                $image = $request->file('image');
                $name = uniqid().'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(150,120)->save('images/admins/'.$name);
                $imgReq = "images/admins/".$name;
                $admin->image = $imgReq;
            }
            
            $admin->save();
            
            $admin->roles()->detach();
            if ($request->roles) {
                $admin->assignRole($request->roles);
            }
            Alert::success('Profile Updated Successfully!', 'thanks for updating admin profile');
            return redirect()->route('admin.user.index');
        }catch(Exception $e){
            Alert::error('SORRY !!', 'Admin prfile updated Failed');
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request, $id)
    {
        try{
            $admin = Admin::find($id);
            $validatedData = $request->validate([
                'current_password' => ['required', 'string'],
                'password' => ['required', 'string', 'min:8'],
                'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
            ], [
                'password.min' => 'The new password must be at least 8 characters long',
                'password_confirmation.same' => 'The new password and confirmation do not match',
            ]);
        
            if (!Hash::check($validatedData['current_password'], $admin->password)) {
                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect']);
            }
        
            if ($validatedData['password']) {
                $admin->password = Hash::make($validatedData['password']);
            }

            $admin->save();
        
            Alert::success('Password Updated Successfully!', 'Thanks for updating your Password');
            return redirect()->back();
        }catch(Exception $e){
            Alert::error('SORRY !!', 'Admin prfile password updated Failed');
            return redirect()->back();
        }
    }


    public function delete($id)
    {
       try{
            if(is_null($this->user) || !$this->user->can('admin.user.delete')){
                abort(403, 'Sorry !! You Are Unothoraize admin then You can\'n delete');
            }
            $admin = Admin::findOrFail($id);

            $old_img = $admin->image;

            if($admin->image){
                unlink($old_img);
            }
            $admin->roles()->detach();
            $admin->delete();

            Alert::success('Profile Deleted Successfully!', 'Deleted Your profile');
            return redirect()->back();
        }catch(Exception $e){
            Alert::error('SORRY !!', 'Admin prfile deleted Failed');
            return redirect()->back();
        }
    }
}
