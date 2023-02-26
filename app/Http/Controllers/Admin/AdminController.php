<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Image;
use Spatie\Permission\Models\Role;

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
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }

        $roles =Role::all();
        $admin = request()->user();
        $state = State::all();
        return view('admin.admins.create', compact('admin', 'state', 'roles'));
    }
    
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.user.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        
        $this->validate($request, [
            'name'=>'required|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed'
        ]);

        $image = $request->file('image');
        if($image){
            
        $name = uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(150,120)->save('images/admins/'.$name);
        $imgReq = "images/admins/".$name;

            $admin = Admin::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'company'=>$request->company,
                'state_id'=>$request->state_id,
                'status'=>$request->status,
                'zip'=>$request->zip,
                'password'=>bcrypt($request->password),
                'image'=>$imgReq
            ]);

            if($request->roles){
                $admin->assignRole($request->roles);
            }

        }else{
            $admin = Admin::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'company'=>$request->company,
                'state_id'=>$request->state_id,
                'status'=>$request->status,
                'zip'=>$request->zip,
                'password'=>bcrypt($request->password)
            ]);

            if($request->roles){
                $admin->assignRole($request->roles);
            }
        }

        Alert::success('Profile Updated Successfully!', 'thanks for some updating your profile');

        return redirect()->route('admin.user.index');
    }

    public function edit($id)
    {
        if(Auth::user()->status == 2){
            $roles  = Role::all();
            $admin = Admin::findOrFail($id);
            $state = State::all();
            return view('admin.admins.edit', compact('admin', 'state', 'roles'));
        }
        abort(403, 'Sorry !! You are Unauthorized to edit any role !');
    }

    public function update(Request $request, $id)
    {

        $admin = Admin::findOrFail($id);

        $image = $request->file('image');

        if($image == true){
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(150,120)->save('images/admins/'.$name);
            $imgReq = "images/admins/".$name;

            $admin->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'company'=>$request->company,
                'state_id'=>$request->state_id,
                'zip'=>$request->zip,
                'image'=>$imgReq
            ]);
            

            $old_img = $request->old_image;
            if($old_img){
                unlink($old_img);
            }
            Alert::success('Profile Updated Successfully!', 'thanks for some updating admin profile & delete old image');

        }else{
            $admin->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'company'=>$request->company,
                'state_id'=>$request->state_id,
                'zip'=>$request->zip,
            ]);

            $admin->roles()->detach();
            if ($request->roles) {
                $admin->assignRole($request->roles);
            }
    
            Alert::success('Admin Profile Updated Successfully!', 'thanks for some updating Admin profile');
        }

        return redirect()->route('admin.user.index');
    }

    public function updatePassword(Request $request, $id)
    {
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
    }


    public function delete($id)
    {
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
    }
}
