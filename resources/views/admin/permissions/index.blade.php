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
            <h2 class="mb-2 page-title">Permission table</h2>
          </div>
          @if( $usr->status == 2 || $usr->can('admin.role_has_permission.create'))
          <div class="col-md-2">
            <a style="float: right" class="btn mb-2 btn-success" href="{{route('admin.role_has_permission.create')}}">Permission Create</a>
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
                      <th width="10%"></th>
                      <th width="20%">#</th>
                      <th width="60%">Permission Group</th>
                      <th width="20%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $permission)
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input">
                          <label class="custom-control-label"></label>
                        </div>
                      </td>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{$permission->group_name}}</td>
                     
                      <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="text-muted sr-only">Action</span>
                        </button>
                        @if( $usr->status == 2 || $usr->can('admin.role_has_permission.edit') || $usr->can('admin.role_has_permission.delete'))
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('admin.role_has_permission.edit', $permission->group_name)}}">Edit</a>
                            <a class="dropdown-item" href="{{route('admin.role_has_permission.delete', $permission->group_name)}}">Remove</a>
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