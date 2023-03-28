@extends('admin.auth.master')
@section('main')
<div class="row align-items-center h-100">
    <form method="POST" action="{{ url('admin/login')}}" class="col-lg-4 col-md-4 col-10 mx-auto " >
        @csrf
      {{-- <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
        <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
          <g>
            <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
            <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
            <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
          </g>
        </svg>
      </a> --}}
      <h1 class="h2 text-center mb-3">Sign in</h1>
      <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control form-control-lg" placeholder="Email address" required>
        @error('email')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control form-control-lg" placeholder="Password" required>
        @error('password')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

     <div class="row">
       <div class="col-lg-6 checkbox mb-3">
         <label>
           <input type="checkbox" name="remember" value="remember-me"> 
           Remember me
          </label>
        </div>
        <div class="col-lg-2"></div>
            <div class="col-lg-4">
              @if (Route::has('password.request'))
                  <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('admin.password.request') }}">
                      {{ __('Forgot your password?') }}
                  </a>
              @endif
          </div>
     </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      <p class="mt-5 mb-3 text-center text-muted">© 2020</p>
    </form>
  </div>
@endsection