@extends('admin.layouts.master')
@section('main')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-1"></div>
      <div class="col-11">
        <h2 class="page-title">User Create Form</h2>
        <p class="text-muted">Provide valuable, actionable feedback to your admins with HTML5 form validation</p>
        <div class="row">
          <div class="col-md-10">
            <div class="card shadow mb-4">
              <div class="card-header">
                <strong class="card-title">Default Validation</strong>
              </div>
              <div class="card-body">
                <form class="needs-validation" action="{{route('admin.user.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                  @csrf
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustomUsername">UserName</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                          </div>
                          <input type="text" name="name" class="form-control" placeholder="Recipient's username" required>
                          <div class="invalid-feedback"> Please choose a username. </div>
                        </div>
                        @error('name')
                          <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
      

                    <div class="col-md-6 mb-3">
                        <label for="simple-select2">UserEmail</label>
                        <div class="input-group">
                          <input type="email" name="email" class="form-control" placeholder="Recipient's useremail" required>
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">@email.com</span>
                          </div>
                          <div class="invalid-feedback"> Please choose a email. </div>
                        </div>

                        @error('email')
                          <span class="text-danger">{{$message}}</span>
                        @enderror

                    </div>
                   
                    <div class="col-md-6 mb-3">
                        <label for="simple-select2">City</label>
                        <select class="form-control select2" name="state_id" id="simple-select2">
                          <option selected disabled value="">Choose select...</option>
                          @foreach ($state as $item)
                          <option value="{{$item->id}}">{{$item->state}}</option>
                          @endforeach
                        </select>
                        <div class="invalid-feedback"> Please select a valid simple. </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="customFile">Image</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image">
                        <label class="custom-file-label" for="customFile">Choose file...</label>
                          <div class="invalid-feedback"> You must input image before submitting. </div>
                      </div>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="multi-select2">Assign Role</label>
                    <select class="form-control select2-multi" name="roles[]" id="multi-select2">
                      @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                      @endforeach
                    </select>
                        @error('roles')
                          <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="simple-select2">Zip</label>
                  <div class="input-group">
                    <input type="text" name="zip" class="form-control" placeholder="admin zip code">
                    <div class="invalid-feedback"> Please choose zip code. </div>
                  </div>

                  @error('zip')
                    <span class="text-danger">{{$message}}</span>
                  @enderror

              </div>


                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    @error('password')
                      <span class="text-danger">{{$message}}</span>
                    @enderror

                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="password">Confirm Password</label>
                      <input type="password" name="password_confirmation" class="form-control" placeholder="confirmation password" required>
                    </div>

                    @error('password_confirmation')
                      <span class="text-danger">{{$message}}</span>
                    @enderror

                  </div>
                  </div>

                  <div class="form-group mb-3">
                    <label for="text-area">Address</label>
                    <textarea name="address"cols="30" rows="4" placeholder="Input Some text" class="form-control"></textarea>
                </div>

                  <div class="form-group">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="status" type="radio" value="1">
                      <label class="form-check-label" for="invalidCheck"> Active User</label>
                      <div class="invalid-feedback"> You must agree before submitting. </div>
                    </div>
                  </div>

                  <button class="btn btn-primary" type="submit">Submit form</button>
                </form>
              </div> <!-- /.card-body -->
            </div> <!-- /.card -->
          </div> <!-- /.col -->
        </div> <!-- end section -->
      </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
    </div>
</div>
@endsection