@extends('layouts.app')

@section('additionalStyles')
  <link rel="stylesheet" href="/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
@endSection

@section('page-name')
  <h1>Detail Pengguna</h1>
@endSection

@section('breadcrumb-list')
  <li><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ url('users') }}">Pengguna</a></li>
  <li class="active">Detail</li>
@endSection

@section('content')
  <div class="row">

    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">General Information</strong>
        </div>
        <div class="card-body">
          <table class="table">
            <tr>
              <td style="width: 40%;">Name</td>
              <td style="width: 5%;">:</td>
              <td>{{ $user->name }}</td>
            </tr>
            <tr>
              <td style="width: 40%;">Email</td>
              <td style="width: 5%;">:</td>
              <td>{{ $user->email }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <!--Card Roles-->
      <div class="card">
        <div class="card-header">
          <strong class="card-title">Roles</strong>
        </div>
        <div class="card-body">
          @if(count($roles))
            @foreach($roles as $role)
              <span class="badge badge-secondary">{{$role}}</span>
            @endforeach
          @endif
        </div>
      </div>
       <!--ENDCard Roles-->
    </div>
  </div>

@endSection

@section('additionalScripts')

@endSection
