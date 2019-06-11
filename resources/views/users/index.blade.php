@extends('layouts.app')

@section('additionalStyles')
  <link rel="stylesheet" href="/vendors/datatables.net/css/select.dataTables.min.css">
  <link rel="stylesheet" href="/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css">
@endSection

@section('page-name')
  <h1>List Pengguna</h1>
@endSection

@section('breadcrumb-list')
  <li><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ url('users') }}">User</a></li>
  <li class="active">Pengguna</li>
@endSection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">
            Tabel List Pengguna
            <span class="float-right">
              <a href="/users/create" class="btn btn-default btn-sm"><i class="fa fa-plus-circle"></i></a>
              <button class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></button>
                <button class="btn btn-default btn-sm" id="btn-delete-user"><i class="fa fa-trash"></i></button>
            </span>
          </strong>
        </div>
        <div class="card-body">
         <div class="table-responsive">
            <table id="table-users" class="table">
              <thead>
                  <tr>
                      <th style="width: 5%; text-align: center;">#</th>
                      <th style="width: 15%;">Name</th>
                      <th>Email</th>
                  </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              {!! Form::open(['url'=>'users/deleteMultiple', 'role'=>'form', 'id'=>'form-delete-users', 'class'=>'form-horizontal', 'method'=>'post']) !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
  </div>
@endSection

@section('additionalScripts')
  <script src="/vendors/datatables.net/js/jquery.dataTables.js"></script>
  <script src="/vendors/datatables.net/js/dataTables.select.min.js"></script>
  <script src="/vendors/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
  <script type="text/javascript">
  (function ($) {
    var tableUsers = $('#table-users').DataTable({
      lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
      processing: true,
      serverSide: true,
      ajax: '{{ url('users/datatables') }}',
      columns: [
        { data: 'checkbox', name: 'checkbox' , orderable:false, searchable:false},
        { data: 'name', name: 'name', render:function(data, type, row){
          return "<a href='/users/"+ row.id +"' class='btn btn-link'>" + row.name + "</a>";
        }},
        { data: 'email', name: 'email' },
        { data: 'id', name: 'id', visible:false },
      ],
      columnDefs: [ {
          orderable: false,
          className: 'select-checkbox',
          targets:0
      }],
      select: {
          style:    'multi',
          selector: 'td:first-child'
      },
      order: [1, 'asc'],

    });

    var selectedUsers = [];
    $('#btn-delete-user').on('click',function(){
      selectedUsers=[];
      var selected_user_ids = tableUsers.rows('.selected').data();
      $.each( selected_user_ids, function( key, value ) {
        selectedUsers.push(selected_user_ids[key].id);
      });
      if(selectedUsers.length == 0){
        alert("Please select user");
      }else{
        $('#form-delete-users').find('.user_id_to_delete').remove();
        $.each( selectedUsers, function( key, value ) {
          $('#form-delete-users').append('<input type="text" class="user_id_to_delete" name="user_id_to_delete[]" value="'+value+'"/>');
        });
        $('#deleteUserModal').modal('show');
      }
      console.log(selectedUsers);
    });
  })(jQuery);
  </script>
@endSection
