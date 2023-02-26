@extends('admin.layouts.master')
@section('main')

<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
        <h2 class="h3 mb-4 page-title">User Role Create</h2>
        <div class="my-4">
          <form method="POST" action="{{route('admin.role.store')}}">
            @csrf
            <hr class="my-2">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="firstname">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Role Name">

                @error('name')
                <span class="text-danger"> {{$message}} </span>
                @enderror
                
              </div>
              <div class="form-group col-md-6">
                <label for="firstname">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Enter Role Email">

                @error('name')
                <span class="text-danger"> {{$message}} </span>
                @enderror
                
              </div>

              <div class="col-md-6 mb-3s">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                @error('password')
                  <span class="text-danger">{{$message}}</span>
                @enderror

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" placeholder="confirmation password" required>
                </div>

                @error('password_confirmation')
                  <span class="text-danger">{{$message}}</span>
                @enderror

              </div>

              <div class="col-md-6 mb-3">
                <label for="multi-select2">Assign Role</label>
                <select class="form-control select2-multi" name="roles[]" id="multi-select2" multiple>
                  @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                  @endforeach
                </select>
                    @error('roles')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
            </div>
            </div>
            {{-- <div class="form-group">
                <label for="name">Give Permission</label>

                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" value="1" class="custom-control-input" id="checkedAllPermissions">
                  <label class="custom-control-label" for="checkedAllPermissions">All Permissions</label>
                </div>

                

                @php $i = 1; @endphp

                @foreach ($permission_groups as $group)
                    <div class="row">
                      <div class="col-3">
                        <hr class="mt-2">
                        <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" name="permissions[]" value="" class="custom-control-input"
                           onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" id="{{ $i }}Management">
                          <label class="custom-control-label" for="{{ $i }}Management">{{$group->name}}</label>
                      </div>
                      </div>

                      <div class="col-9 mb-3 role-{{ $i }}-management-checkbox">
                        <hr class="mt-2">
                        @php
                            $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                            $j = 1;
                        @endphp
  
                        @foreach ($permissions as $permission)
                          <div class="custom-control custom-checkbox mb-3">
                              <input type="checkbox" name="permissions[]" value="{{$permission->name}}" class="custom-control-input" id="customCheck{{$permission->id}}">
                              <label class="custom-control-label" for="customCheck{{$permission->id}}">{{$permission->name}}</label>
                          </div>

                          @php $j++; @endphp

                        @endforeach
                      </div>
                    </div>

                    @php $i++; @endphp

                @endforeach
            </div> --}}
           
            <button type="submit" class="btn mb-2 btn-secondary">Create Role</button>
          </form>

            <hr class="my-4">
            



        </div> <!-- /.card-body -->
      </div> <!-- /.col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->
@endsection

@section('styles')
    <style>
      label.custom-control-label {
          text-transform: capitalize;
      }
    </style>
@endsection

@section('scripts')
    @include('admin.layouts.roleScript')
@endsection
