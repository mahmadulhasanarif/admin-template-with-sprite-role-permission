@extends('admin.layouts.master')
@section('main')

<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
        <h2 class="h3 mb-4 page-title">Profile Settings</h2>
        <div class="my-4">
          <form method="POST" action="{{route('admin.profile.update')}}" enctype="multipart/form-data">
            @csrf
            <div class="row mt-5 align-items-center">
              <div class="col-md-3 text-center mb-5">
                <div class="avatar avatar-xl">
                  <img src="{{!empty($user->image) ? url($user->image) : url('images/admins/No_Image.jpg')}}" height="100px" width="120px" id="showImage" class="avatar-img rounded-circle">
                </div>
                <div class="custom-file mb-3 mt-3">
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    <input type="file" class="custom-file-input" name="image" value="{{old('image', $user->image)}}" id="image">
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>
              </div>
              <div class="col">
                <div class="row align-items-center">
                  <div class="col-md-7">
                    <h4 class="mb-1">{{$user->name}}</h4>
                    <p class="small mb-3"><span class="badge badge-dark">{{ !empty($user->address) ? $user->address : "Dhaka Bangladesh" }}</span></p>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col-md-7">
                    <p class="text-muted"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit nisl ullamcorper</p>
                  </div>
                  <div class="col">
                    <p class="small mb-0 text-muted">
                      {{ !empty($user->phone) ? $user->phone : "+8801725-0000000" }}
                    </p>
                    <p class="small mb-0 text-muted">
                      {{ !empty($user->state->name) ? $user->state->name : "No State Availabe" }}
                    </p>
                    <p class="small mb-0 text-muted">
                      {{ !empty($user->zip) ? $user->zip : "2200" }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <input type="hidden" name="old_image" value="{{$user->image}}">
              <div class="form-group ">
                <label for="firstname">Name</label>
                <input type="text" name="name" class="form-control" value="{{old('name', $user->name)}}">
              </div>
            <div class="form-group">
              <label for="inputEmail4">Email</label>
              <input type="email" name="email" class="form-control" value="{{old('email', $user->email)}}">
            </div>
            <div class="form-group">
              <label for="inputAddress5">Address</label>
              <input type="text" name="address" class="form-control" value="{{old('address', $user->address)}}" placeholder="mymensingh sadar">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCompany5">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{old('phone', $user->phone)}}" placeholder="+881017-54535">
              </div>
              <div class="form-group col-md-4">
                <label for="inputState5">State</label>
                <select id="inputState5" name="state_id" class="form-control">
                  <option selected="" disabled>Choose...</option>
                  @foreach ($state as $item)
                  <option value="{{$item->id}}" {{ $item->id == $user->state_id ? 'selected' : '' }}>{{$item->state}}</option>
                  @endforeach
                  
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputZip5">Zip</label>
                <input type="text" class="form-control" name="zip" value="{{old('zip', $user->zip)}}" placeholder="2204">
              </div>
            </div>
            <button type="submit" class="btn mb-2 btn-secondary">Save Change</button>
          </form>

            <hr class="my-4">
            
            <form action="{{route('admin.profile.password.update')}}" method="POST">
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

          <div class="row mb-4">
            <div class="col-md-12">
              <h3 class="mb-2">Delete Account</h3>
                <p class="small text-muted mb-2"> 
                  Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                </p>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                DELETE ACCOUNT
              </button>
              <!-- Modal -->
              <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <form action="{{route('admin.profile.destroy')}}" method="post">
                    @csrf
                    @method('delete')
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabel">Delete Account</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="inputPassword5">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="password" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                      <button type="submit" class="btn btn-primary">Delete Account</button>
                    </div>
                  </div>
                </div>
              </form>
              </div>

            </div>
          </div>

        </div> <!-- /.card-body -->
      </div> <!-- /.col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $('#image').change(function(e){
        let reader = new FileReader();
        reader.onload = function(e){
          $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
      });
    });
  </script>
@endsection