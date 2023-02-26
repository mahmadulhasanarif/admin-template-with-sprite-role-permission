@extends('admin.layouts.master')
@section('main')

<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
        <h2 class="h3 mb-4 page-title">User Role Edit</h2>
        <div class="my-4">
          <form method="POST" action="{{route('admin.role.update', $role->id)}}">
            @csrf
            <hr class="my-2">
            <input type="hidden" name="guard_name" value="web">
              <div class="form-group ">
                <label for="firstname">Name</label>
                <input type="text" name="name" value="{{old('name', $role->name)}}" class="form-control" placeholder="Enter Role Name">

                @error('name')
                <span class="text-danger"> {{$message}} </span>
                @enderror
                
              </div>

            <div class="form-group">
                <label for="name">Give Permission</label>

                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" value="1" id="checkedAllPermissions"
                  {{ App\Models\Admin::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                  <label class="custom-control-label" for="checkedAllPermissions">All Permissions</label>
                </div>

                

                @php $i = 1; @endphp

                @foreach ($permission_groups as $group)
                    <div class="row">

                        @php
                            $permissions = App\Models\Admin::getpermissionsByGroupName($group->name);
                            $j = 1;
                        @endphp

                      <div class="col-3">
                        <hr class="mt-2">
                        <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" name="permissions[]" {{ $group->name }} class="custom-control-input"
                          onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" id="{{ $i }}Management"
                          {{ App\Models\Admin::roleHasPermissions($role, $permissions) ? 'checked' : '' }} value="">
                          <label class="custom-control-label" for="{{ $i }}Management">{{$group->name}}</label>
                      </div>
                      </div>

                      <div class="col-9 mb-3 role-{{ $i }}-management-checkbox">
                        <hr class="mt-2">
                       
  
                        @foreach ($permissions as $permission)
                          <div class="custom-control custom-checkbox mb-3">
                              <input type="checkbox" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}  
                              value="{{$permission->name}}" class="custom-control-input" id="customCheck{{$permission->id}}"
                              onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})">
                              <label class="custom-control-label" for="customCheck{{$permission->id}}">{{$permission->name}}</label>
                          </div>

                          @php $j++; @endphp

                        @endforeach
                      </div>
                    </div>

                    @php $i++; @endphp

                @endforeach
            </div>
           
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
