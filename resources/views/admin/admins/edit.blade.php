@extends('admin.layouts.master')
@section('main')

<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
        <h2 class="h3 mb-4 page-title">User Profile Edit</h2>
        <div class="my-4">
          <form method="POST" action="{{route('admin.user.update', $admin->id)}}" enctype="multipart/form-data">
            @csrf
            <hr class="my-4">
            <input type="hidden" name="old_image" value="{{$admin->image}}">
              <div class="form-group ">
                <label for="firstname">Name</label>
                <input type="text" name="name" class="form-control" value="{{old('name', $admin->name)}}">
              </div>
            <div class="form-group">
              <label for="inputEmail4">Email</label>
              <input type="email" name="email" class="form-control" value="{{old('email', $admin->email)}}">
            </div>
            <div class="form-group">
              <label for="inputAddress5">Address</label>
              <input type="text" name="address" class="form-control" value="{{old('address', $admin->address)}}" placeholder="mymensingh sadar">
            </div>

           
            
            <div class="form-row">

              <div class="col-md-6 mb-3">
                <label for="multi-select2">Multiple Select</label>
                <select class="form-control select2-multi" name="roles[]" id="multi-select2" multiple>
                  @foreach ($roles as $role)
                    <option value="{{$role->id}}" {{ $admin->hasRole($role->name) ? 'selected': '' }}>{{$role->name}}</option>
                  @endforeach
                </select>
                    @error('roles')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
            </div>

              <div class="form-group col-md-6">
                <label for="inputCompany5">Company</label>
                <input type="text" name="company" class="form-control" value="{{old('company', $admin->company)}}" placeholder="Nec Urna Suscipit Ltd">
              </div>

              <div class="form-group col-md-6">
                <label for="inputState5">State</label>
                <select id="inputState5" name="state_id" class="form-control">
                  <option selected="" disabled>Choose...</option>
                  @foreach ($state as $item)
                  <option value="{{$item->id}}" {{ $item->id == $admin->state_id ? 'selected' : '' }}>{{$item->state}}</option>
                  @endforeach
                  
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="inputZip5">Zip</label>
                <input type="text" class="form-control" name="zip" value="{{old('zip', $admin->zip)}}" placeholder="2204">
              </div>
            </div>
            <div class="form-row">
            
            <div class="col-md-6 mb-3">
                <label for="customFile">Image</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="image">
                  <label class="custom-file-label" for="customFile">Choose file...</label>
                    <div class="invalid-feedback"> You must input image before submitting. </div>
                </div>
            </div>

            <div class="col-md-1"></div>
            @if ($admin->image == true)
            <div class="form-group col-md-5">
                <img src="{{asset($admin->image)}}" alt="">
            </div>
            @endif
            </div>
            <button type="submit" class="btn mb-2 btn-secondary">Save Change</button>
          </form>

            <hr class="my-4">
            
            <form action="{{route('admin.user.password.update', $admin->id)}}" method="POST">
                @csrf
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputPassword4">Old Password</label>
                  <input type="password" name="current_password" class="form-control" required>

                 <span class="text-danger">
                    @error('current_password')
                      <div>{{ $message }}</div>
                    @enderror
                 </span>

                </div>
                <div class="form-group">
                  <label for="inputPassword5">New Password</label>
                  <input type="password" name="password" class="form-control" required>

                  <span class="text-danger">
                    @error('password')
                      <div>{{ $message }}</div>
                    @enderror
                  </span>

                </div>
                <div class="form-group">
                  <label for="inputPassword6">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" required>

                  <span class="text-danger">
                    @error('password_confirmation')
                      <div>{{ $message }}</div>
                    @enderror
                  </span>

                </div>
              </div>
              <div class="col-md-6">
                <p class="mb-2">Password requirements</p>
                <p class="small text-muted mb-2"> To create a new password, you have to meet all of the following requirements: </p>
                <ul class="small text-muted pl-4 mb-0">
                  <li> Minimum 8 character </li>
                  <li>At least one special character</li>
                  <li>At least one number</li>
                  <li>Can’t be the same as a previous password </li>
                </ul>
              </div>
            </div>
            <button type="submit" class="btn mb-2 btn-secondary">Save Change</button>
          </form>

          <hr class="my-4">

        </div> <!-- /.card-body -->
      </div> <!-- /.col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->
@endsection