@php
    $usr = Auth::guard('admin')->user();
@endphp

@extends('admin.layouts.master')
@section('main')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="row">
          <div class="col-md-10">
            <h2 class="mb-2 page-title">Role table</h2>
          </div>
          @if($usr->can('admin.role.create') || $usr->status == 2)
          <div class="col-md-2">
            <a style="float: right" class="btn mb-2 btn-success" href="{{route('admin.role.create')}}">Role Create</a>
          </div>
          @endif
        </div>
        <div class="row my-4">
          <div class="col-md-12">
            <div class="card shadow">
              <div class="card-body">
                <table class="table datatables" id="dataTable-1">
                  <thead>
                    <tr>
                      <th width="0"></th>
                      <th width="10%">#</th>
                      <th width="15%">Name</th>
                      <th width="60%">Permission</th>
                      @if ($usr->can('admin.role.edit') || $usr->can('admin.role.delete') || $usr->status == 2)
                      <th width="15%">Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($roles as $role)
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input">
                          <label class="custom-control-label"></label>
                        </div>
                      </td>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{$role->name}}</td>
                      <td>
                        @foreach ($role->permissions as $perm)
                            <span class="badge badge-success mr-1">
                                {{ $perm->name }}
                            </span>
                        @endforeach
                      </td>
                      
                      <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-muted sr-only">Action</span>
                      </button>
                      @if ($usr->can('admin.role.edit') || $usr->can('admin.role.delete') || $usr->status == 2)
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('admin.role.edit', $role->id)}}">Edit</a>
                            <a class="dropdown-item" href="{{route('admin.role.delete', $role->id)}}">Remove</a>
                          </div>
                          @endif
                      </td>
                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div> <!-- simple table -->
        </div> <!-- end section -->
      </div> <!-- .col-12 -->
    </div>
</div>
@endsection