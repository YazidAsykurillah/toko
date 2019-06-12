@extends('layouts.app')

@section('additionalStyles')
  <link rel="stylesheet" href="/vendors/datatables.net/css/select.dataTables.min.css">
  <link rel="stylesheet" href="/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css">
@endSection

@section('page-name')
  <h1>Product List</h1>
@endSection

@section('breadcrumb-list')
  <li><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ url('product') }}">Product</a></li>
  <li class="active">Index</li>
@endSection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">
            Product List
          </strong>
          <span class="float-right">
              <a href="/product/create" class="btn btn-default btn-sm"><i class="fa fa-plus-circle"></i></a>
              <button class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></button>
              <button class="btn btn-default btn-sm" id="btn-delete-user"><i class="fa fa-trash"></i></button>
            </span>
        </div>
        <div class="card-body">
         <div class="table-responsive">
            <table id="table-product" class="table">
              <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">#</th>
                    <th style="width: 10%;">Name</th>
                    <th style="width: 15%;">Category</th>
                    <th style="width: 10%;">Unit</th>
                    <th>Detail</th>
                    <th style="width: 10%;">Stock</th>
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
  <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              {!! Form::open(['url'=>'product/deleteMultiple', 'role'=>'form', 'id'=>'form-delete-product', 'class'=>'form-horizontal', 'method'=>'post']) !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
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
    //Define selected products
    var selectedProducts = [];

    //Build datatable
    var tableProduct = $('#table-product').DataTable({
      lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
      processing: true,
      serverSide: true,
      ajax: '{{ url('datatables/product') }}',
      columns: [
        { data: 'checkbox', name: 'checkbox' , orderable:false, searchable:false},
        { data: 'name', name: 'name', render:function(data, type, row){
          return "<a href='/product/"+ row.id +"' class='btn btn-link'>" + row.name + "</a>";
        }},
        { data: 'product_category.name', name: 'product_category.name', orderable:true },
        { data: 'product_unit.name', name: 'product_unit.name', orderable:false  },
        { data: 'detail', name: 'detail', orderable:false },
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
    $('#btn-delete-user').on('click',function(){
      selectedProducts=[];
      var selected_user_ids = tableProduct.rows('.selected').data();
      $.each( selected_user_ids, function( key, value ) {
        selectedProducts.push(selected_user_ids[key].id);
      });
      if(selectedProducts.length == 0){
        $('#emptyDataModal').modal('show');
      }else{
        $('#form-delete-product').find('.user_id_to_delete').remove();
        $.each( selectedProducts, function( key, value ) {
          $('#form-delete-product').append('<input type="text" class="user_id_to_delete" name="user_id_to_delete[]" value="'+value+'"/>');
        });
        $('#deleteProductModal').modal('show');
      }
      console.log(selectedProducts);
    });
  })(jQuery);
  </script>
@endSection
