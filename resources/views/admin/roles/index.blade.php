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
          @if($usr->can('admin.role.create'))
          <div class="col-md-2">
            <a style="float: right" class="btn mb-2 btn-success" href="{{route('admin.role.create')}}">Role Create</a>
          </div>
          @endif
        </div>
        <p class="card-text">DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, built upon the foundations of progressive enhancement, that adds all of these advanced.</p>
        <div class="row my-4">
          <div class="col-md-12">
            <div class="card shadow">
              <div class="card-body">
                <table class="table datatables" id="dataTable-1">
                  <thead>
                    <tr>
                      <th></th>
                      <th>#</th>
                      <th>Name</th>
                      <th>Permission</th>
                      @if ($usr->can('admin.role.edit') || $usr->can('admin.role.delete'))
                      <th>Action</th>
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
                      @if ($usr->can('admin.role.edit') || $usr->can('admin.role.delete'))
                     
                      <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="text-muted sr-only">Action</span>
                        </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('admin.role.edit', $role->id)}}">Edit</a>
                            <a class="dropdown-item" href="{{route('admin.role.delete', $role->id)}}">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                      </td>
                      
                      @endif
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