@extends('layouts.app')

@section('content')


<!-- Default Light Table -->
<div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Doctors</span>
                <h3 class="page-title">Listes of Doctors</h3>
              </div>
            </div>
<div class="row">
              <div class="col">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Active Users</h6>
                  </div>
                  <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                      <thead class="bg-light">
                      <tr>
                          <th scope="col" class="border-bottom-0">#</th>
                          <th scope="col" class="border-bottom-0">Image</th>
                          <th scope="col" class="border-bottom-0">First Name</th>
                          <th scope="col" class="border-bottom-0">Last Name</th>
                          <th scope="col" class="border-bottom-0">Phone</th>
                          <th scope="col" class="border-bottom-0">Statu</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($doctors as $doctor)
                        <tr>
                          <td>{{ $doctor->id }}</td>
                          <td><img class="rounded-circle" src="{{asset('assets/img/avatars/doctor.jpg')}}" style="height:2%;" alt=""></td>
                          <td>{{ $doctor->first_name }}</td>
                          <td>{{ $doctor->last_name }}</td>
                          <td>{{ $doctor->phone }}</td>
                          <td>{{ $doctor->status }}</td>
                        </tr>
                       @endforeach
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->
            </div>



@endsection