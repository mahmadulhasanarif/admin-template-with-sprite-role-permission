@extends('admin.layouts.master')
@section('main')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="mb-2 page-title">Data view table</h2>
        <p class="card-text">It is a highly flexible tool, built upon the foundations of progressive enhancement, that adds all of these advanced features to any HTML table. </p>
        <div class="row my-4">
          <div class="col-md-12">
            <div class="card shadow">
              <div class="card-body">
                <table class="table datatables" id="dataTable-1">
                  <thead>
                    <tr>
                      <th></th>
                      <td></td>
                    </tr>

                    <tr>
                      <th>ID</th>
                      <td>1</td>
                    </tr>
                    <tr>
                      <th>Name</th>
                      <td>admin</td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td>admin@gmail.com</td>
                    </tr>

                    <tr>
                      <th>Token</th>
                      <td>remebmerTOken</td>
                    </tr>
                    <tr>
                      <th>Image</th>
                      <td><img src="{{asset('backend/assets/avatars/face-3.jpg')}}" width="150px" height="100px"></td>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div> <!-- simple table -->
        </div> <!-- end section -->
      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div> 
  <!-- .container-fluid -->
@endsection