@extends('layouts.app')

@section('page-title')
  Product Unit Detail
@endsection

@section('additionalStyles')
  <link rel="stylesheet" href="/vendors/datatables.net/css/select.dataTables.min.css">
  <link rel="stylesheet" href="/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css">
@endSection

@section('page-name')
  <h1>Product Unit Detail</h1>
@endSection

@section('breadcrumb-list')
  <li><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ url('product-unit') }}">Product Unit</a></li>
  <li class="active">Detail</li>
@endSection

@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">
            Product Unit Detail
          </strong>
          <span class="float-right">
            <a href="{{ url('product-unit/'.$productUnit->id.'/edit') }}" class="btn btn-default btn-sm">
              <i class="fa fa-pencil"></i>
            </a>
          </span>
        </div>
        <div class="card-body">
         <div class="table-responsive">
            <table class="table">
              <tr>
                <td style="width: 15%;">Name</td>
                <td style="width: 5%;">:</td>
                <td>{{ $productUnit->name}}</td>
              </tr>
              <tr>
                <td style="width: 15%;">Description</td>
                <td style="width: 5%;">:</td>
                <td>{{ $productUnit->description}}</td>
              </tr>
            </table>
          </div>
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
    
  })(jQuery);
  </script>
@endSection
