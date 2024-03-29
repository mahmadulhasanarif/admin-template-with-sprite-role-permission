<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\State;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class ProfileController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    
    public function editProfile()
    {
        $user = request()->user();
        $state = State::all();
        return view('admin.profile.edit', compact('user', 'state'));
    }

    public function updateProfile(Request $request)
    {
        try{
            $admin = $request->user();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->address = $request->address;
            $admin->phone = $request->phone;
            $admin->state_id = $request->state_id;
            $admin->zip = $request->zip;

            $old_img = $request->old_image;
            if($old_img == true){
                @unlink($old_img);
            }
            $image = $request->file('image');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(150,120)->save('images/admins/'.$name);
            $imgReq = "images/admins/".$name;

            $admin->image = $imgReq;
            $admin->save();
            Alert::success('Profile Updated Successfully!', 'thanks for some updating your profile');
            return redirect()->back();
        }catch(Exception $e){
            Alert::error('SORRY !!', 'Profile Updated failed!');
			return redirect()->back();
        }
    }

    public function updatePassword(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'current_password' => ['required', 'string'],
                'password' => ['required', 'string', 'min:8'],
                'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
            ], [
                'password.min' => 'The new password must be at least 8 characters long',
                'password_confirmation.same' => 'The new password and confirmation do not match',
            ]);
        
            if (!Hash::check($validatedData['current_password'],  $request->user()->password)) {
                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect']);
            }
        
            if ($validatedData['password']) {
                $request->user()->password = Hash::make($validatedData['password']);
            }

            $request->user()->save();
        
            Alert::success('Password Updated Successfully!', 'Thanks for updating your Password');
            return redirect()->back();
        }catch(Exception $e){
			Alert::error('Sorry!', 'Updaete Failed profile');
			return redirect()->back();
		}
    }

    public function destroy(Request $request): RedirectResponse
    {
        try{
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current-password'],
            ]);
    
            $user = $request->user();
    
            $image = $user->image;
    
            if($image == true){
                @unlink($image);
            }
    
            Auth::logout();
    
            $user->delete();
    
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return Redirect::to('/');

        }catch(Exception $e){
			Alert::error('Sorry!', 'You are not able to destroy admin');
			return redirect()->back();
		}
    }

    public function status(Admin $admin)
    {
        try{
            if(is_null($this->user) || !$this->user->can('admin.profile.status')){
                abort(403, "Sorry !! You are not unothorize user then You Can't Status Update");
            }
            if($admin->status == 0){
                $admin->update(['status'=>1]);
            }else{
                $admin->update(['status'=>0]);
            }
            Alert::success('Status Updated Successfully', 'Thanks for updating status');
            return redirect()->back();

        }catch(Exception $e){
			Alert::error('Sorry!', 'You are unothorize to upated status');
			return redirect()->back();
		}
    }

}
