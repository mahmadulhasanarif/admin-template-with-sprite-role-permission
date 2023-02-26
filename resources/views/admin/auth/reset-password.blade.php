@extends('admin.auth.master')
@section('main')
<div class="row align-items-center h-100">
    <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="POST" action="{{ route('admin.password.store') }}">
        @csrf
      <div class="mx-auto text-center my-4">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
          <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
            <g>
              <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
              <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
              <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
            </g>
          </svg>
        </a>
        <h2 class="my-3">Reset Password</h2>
      </div>
      <p class="text-muted">Enter your email address and we'll send you an email with instructions to reset your password</p>
      <div class="form-group">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" value="{{old('email', $request->email)}}" class="form-control form-control-lg" placeholder="Email address" required="" autofocus="">
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="password" required autofocus="">
      </div>
      <div class="form-group">
        <label for="password_confirmation" class="sr-only">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" placeholder="Email address" required autofocus="">
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
      <p class="mt-5 mb-3 text-muted">© 2023</p>
    </form>
  </div>
@endsection