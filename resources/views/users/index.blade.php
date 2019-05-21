@extends('layouts.app')

@section('additionalStyles')
  <link rel="stylesheet" href="/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.css">
@endSection

@section('page-name')
  <h1>List Pengguna</h1>
@endSection

@section('breadcrumb-list')
  <li><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
  <li class="active">Pengguna</li>
@endSection

@section('content')
  <div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">Tabel List Pengguna</strong>
        </div>
        <div class="card-body">
          <table id="table-users" class="table">
            <thead>
                <tr>
                    <th style="width: 10%;">#</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endSection

@section('additionalScripts')
  <script src="/vendors/datatables.net/js/jquery.dataTables.js"></script>
  <script src="/vendors/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
  <script type="text/javascript">
    (function ($) {
      $('#table-users').DataTable({
        lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
        processing: true,
        serverSide: true,
        ajax: '{{ url('users/datatables') }}',
        columns: [
          { data: 'rownum', name: 'rownum' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' }
        ]
      });
    })(jQuery);

  </script>
@endSection
