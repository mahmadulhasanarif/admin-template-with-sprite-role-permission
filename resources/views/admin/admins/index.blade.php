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
            <h2 class="mb-2 page-title">Admin Data table</h2>
          </div>
          @if ($usr->can('admin.user.create') || $usr->status == 2)

          <div class="col-md-2">
            <a style="float: right" class="btn mb-2 btn-success" href="{{route('admin.user.create')}}">Admin Create</a>
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
                      <th></th>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Roles</th>
                      <th>City</th>
                      <th>Status</th>
                      <th>Date</th>
                      @if ($usr->can('admin.user.edit') || $usr->can('admin.user.delete') || $usr->status == 2)
                      <th>Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($admins as $item)
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input">
                          <label class="custom-control-label"></label>
                        </div>
                      </td>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->email}}</td>
                      <td>
                        @foreach ($item->roles as $role)

                            <span class="badge badge-success mr-1">
                                {{ $role->name }}
                            </span>
                        @endforeach
                      </td>
                      <td>@if($item->state_id){{$item->state->state}} @else City Not Availabe @endif</td>
                      <td>
                        @if($item->status == 1)
                          <p class="badge badge-success mr-1">Active</p>
                        @elseif ($item->status == 2)
                        <p class="badge badge-success mr-1">S-Admin</p>
                        @else 
                          <p class="badge badge-danger mr-1">Deactive</p> 
                        @endif
                      </td>
                      <td>{{$item->created_at->format('d / m / y')}}</td>
                      @if ($usr->can('admin.user.edit') || $usr->can('admin.user.delete') || $usr->status == 2)

                      <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="text-muted sr-only">Action</span>
                        </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('admin.user.edit', $item->id)}}">Edit</a>
                            <a class="dropdown-item" href="{{route('admin.user.delete', $item->id)}}">Remove</a>
                            @if (Auth::user()->status == 2)
                            <a class="dropdown-item" href="{{route('admin.profile.status', $item->id)}}">Assign</a>
                            @endif
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