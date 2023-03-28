@extends('admin.layouts.master')
@section('main')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
        <h3 class="h3 mb-4 page-title">Permission Edit </h3>
        <div class="my-4">
          <form method="POST" action="{{route('admin.role_has_permission.update', $data[0]->group_name)}}">
            @csrf
            <hr class="my-4">
            <div class="add_item">

              <div class="form-group ">
                <label for="firstname">Group Name</label>
                    <input type="text" name="group_name" value="{{old('group_name', $data[0]->group_name)}}" class="form-control" placeholder="Enter permission group Name">
                    @error('group_name')
                    <span class="text-danger"> {{$message}} </span>
                    @enderror
              </div>

              
              @foreach ($data as $singleData)
              <div class="delete_whole_extra_item">
              <div class="row">

               
                <div class="form-group col-md-9">
                  <label for="firstname">Name</label>
                  <input type="text" name="name[]" value="{{ $singleData->name}}" class="form-control" placeholder="Enter permission Name">
                  @error('name')
                  <span class="text-danger"> {{$message}} </span>
                  @enderror
              </div>
  
  
                <div class="col-lg-2 addEvent">
                  <span class="btn btn-success addEventMore"><i class="fa fa-plus-circle"></i></span>
                  <span class="btn btn-danger removeEventMore"><i class="fa fa-minus-circle"></i></span>
                </div>
  
               </div>
              </div>
              @endforeach
            </div>
           
            <button type="submit" class="btn mb-2 btn-secondary">Save Change</button>
          </form>

        </div> <!-- /.card-body -->
      </div> <!-- /.col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->


  <div style="visibility: hidden;">
    <div class="whole_extra_item_add">
      <div class="delete_whole_extra_item">
        <div class="form-row">
          
            <div class="form-group col-md-9">
                <label for="firstname">Name</label>
                <input type="text" name="name[]" class="form-control" placeholder="Enter permission Name">
                @error('name')
                <span class="text-danger"> {{$message}} </span>
                @enderror
            </div>


          <div class="col-lg-2 addEvent">
            <span class="btn btn-success addEventMore"><i class="fa fa-plus-circle"></i></span>
            <span class="btn btn-danger removeEventMore"><i class="fa fa-minus-circle"></i></span>
          </div>

        </div>
      </div>
    </div>

  </div>
@endsection

@section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
  <style>
    .addEvent{
      padding-top: 28px;
    }
    .removeEventMore{
      padding-top: 10px;
    }
    .addEventMore{
      padding-top: 10px;
    }
  </style>
@endsection

@section('scripts')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      let counter = 0;
      $(document).on("click", '.addEventMore', function(){
        let whole_extra_item_add = $('.whole_extra_item_add').html();
        $(this).closest('.add_item').append(whole_extra_item_add);
        counter++;
      });

      $(document).on("click", '.removeEventMore', function(){
        let delete_whole_extra_item = $('.delete_whole_extra_item').html();
        $(this).closest('.delete_whole_extra_item').remove();
        counter -= 1;
      });
    });
  </script>
@endsection