@extends('layouts.app')

@section('page-title')
  Product Unit List
@endsection

@section('additionalStyles')
  <link rel="stylesheet" href="/vendors/datatables.net/css/select.dataTables.min.css">
  <link rel="stylesheet" href="/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css">
@endSection

@section('page-name')
  <h1>Product Unit List</h1>
@endSection

@section('breadcrumb-list')
  <li><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ url('product-unit') }}">Product Unit</a></li>
  <li class="active">Index</li>
@endSection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">
            Product Unit Table
          </strong>
          <span class="float-right">
            <a href="/product-unit/create" class="btn btn-default btn-sm"><i class="fa fa-plus-circle"></i></a>
            <button class="btn btn-default btn-sm" id="btn-delete-product-unit"><i class="fa fa-trash"></i></button>
          </span>
        </div>
        <div class="card-body">
         <div class="table-responsive">
            <table id="table-product-unit" class="table">
              <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">#</th>
                    <th style="width: 10%;">Name</th>
                    <th>Description</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Delete modal-->
  <div class="modal fade" id="deleteProductUnitModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductUnitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteProductUnitModalLabel">Delete Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="alert alert-warning">
            <i class="fa fa-warning"></i> <span id="delete-counter"></span> product unit will be deleted
          </p>
          {!! Form::open(['url'=>'product-unit/deleteMultiple', 'role'=>'form', 'id'=>'form-delete-product-unit', 'class'=>'form-horizontal', 'method'=>'post']) !!}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <!--END Delete modal-->

  <!--Empty Data Modal-->
  <div class="modal fade" id="emptyDataModal" tabindex="-1" role="dialog" aria-labelledby="emptyDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <p class="alert alert-warning"><i class="fa fa-warning"></i> Please select at least a data to delete</p>
        </div>
      </div>
    </div>
  </div>
  <!--END Empty Data Modal-->
@endSection

@section('additionalScripts')
  <script src="/vendors/datatables.net/js/jquery.dataTables.js"></script>
  <script src="/vendors/datatables.net/js/dataTables.select.min.js"></script>
  <script src="/vendors/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
  <script type="text/javascript">
  (function ($) {
    //Define selected product units
    var selectedProductUnits = [];

    //Build datatable
    var tableProductUnit = $('#table-product-unit').DataTable({
      lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
      processing: true,
      serverSide: true,
      ajax: '{{ url('datatables/productUnit') }}',
      columns: [
        { data: 'checkbox', name: 'checkbox' , orderable:false, searchable:false},
        { data: 'name', name: 'name', render:function(data, type, row){
          return "<a href='/product-unit/"+ row.id +"' class='btn btn-link'>" + row.name + "</a>";
        }},
        { data: 'description', name: 'description' },
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

    //Delete handling
    $('#btn-delete-product-unit').on('click',function(){
      selectedProductUnits=[];
      var selected_product_unit_ids = tableProductUnit.rows('.selected').data();
      $.each( selected_product_unit_ids, function( key, value ) {
        selectedProductUnits.push(selected_product_unit_ids[key].id);
      });
      if(selectedProductUnits.length == 0){
        $('#emptyDataModal').modal('show');
      }else{
        $('#form-delete-product-unit').find('.id_to_delete').remove();
        $.each( selectedProductUnits, function( key, value ) {
          $('#form-delete-product-unit').append('<input type="hidden" class="id_to_delete" name="id_to_delete[]" value="'+value+'"/>');
        });
        $('#delete-counter').html(selectedProductUnits.length);
        $('#deleteProductUnitModal').modal('show');
      }
      console.log(selectedProductUnits);
    });
  })(jQuery);
  </script>
@endSection
