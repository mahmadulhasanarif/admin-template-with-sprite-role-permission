@extends('admin.layouts.master')
@section('main')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-1"></div>
        <div class="col-10">
            
            <!-- search option start -->
          <div class="card">
              <div class="card-header">
                  <strong> Role Create </strong>
              </div>
              <div class="card-body shadow">
                <form method="POST" action="{{route('admin.role.store')}}">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="firstname">Name</label>
                      <input type="text" name="name" class="form-control" placeholder="Enter Role Name">
      
                      @error('name')
                      <span class="text-danger"> {{$message}} </span>
                      @enderror
                      
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
                 <div class="col-md-6" style="padding: 28px">
                   <button type="submit" class="btn mb-2 btn-secondary">Create Role</button>
                 </div>
                </div>
                </form>
               </div>
              </div>
          </div>
        <!-- search option End -->
        <div class="col-1"></div>

        <hr>

      </div> <!-- .col-12 -->
    </div>
</div>
@endsection