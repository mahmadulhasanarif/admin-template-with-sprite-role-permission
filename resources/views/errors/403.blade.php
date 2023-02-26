@extends('errors.master')
@section('main')
<div class="align-items-center h-100 d-flex w-50 mx-auto">
    <div class="mx-auto text-center">
      <h1 class="display-1 m-0 font-weight-bolder text-muted" style="font-size:80px;">403</h1>
      <h1 class="mb-1 text-muted font-weight-bold">OOPS!</h1>
      <h6 class="mb-3 text-muted">The page could not be Unothorize Access.</h6>

      <h6 class="mb-3 text-muted">
            {{$exception->getMessage()}}
      </h6>
      <a href="{{route('admin.dashboard')}}" class="btn btn-lg btn-primary px-5">Back to Dashboard</a>
    </div>
  </div>
@endsection