@extends('layouts.app')

@section('additionalStyles')
  <link rel="stylesheet" href="/vendors/datatables.net/css/select.dataTables.min.css">
  <link rel="stylesheet" href="/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="/vendors/select2/css/select2.css">
@endSection

@section('page-name')
  <h1>Create Product</h1>
@endSection

@section('breadcrumb-list')
  <li><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ url('product') }}">Product</a></li>
  <li class="active">Create</li>
@endSection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">
            Create Product Form
          </strong>
        </div>
        {!! Form::open(['route'=>'product.store','role'=>'form','class'=>'form-horizontal','id'=>'form-store-product','files'=>true]) !!}
        <div class="card-body card-block">
            <div class="row form-group">
              <div class="col col-md-2">
                <label for="name" class=" form-control-label">Name</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" id="name" name="name" placeholder="Product name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">
                @if ($errors->has('name'))
                  <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-2">
                <label for="category_id" class=" form-control-label">Category</label>
              </div>
              <div class="col-12 col-md-9">
                <select name="category_id" id="category_id" class="form-control {{ $errors->has('category_id') ? ' is-invalid' : '' }}">
                    <option value="">Please select</option>
                    <option value="1">Option #1</option>
                    <option value="2">Option #2</option>
                    <option value="3">Option #3</option>
                </select>
                @if ($errors->has('category_id'))
                  <span class="help-block">{{ $errors->first('category_id') }}</span>
                @endif
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-2">
                <label for="unit_id" class=" form-control-label">Unit</label>
              </div>
              <div class="col-12 col-md-9">
                <select name="unit_id" id="unit_id" class="form-control {{ $errors->has('unit_id') ? ' is-invalid' : '' }}">
                    <option value="">Please select</option>
                    <option value="1">Option #1</option>
                    <option value="2">Option #2</option>
                    <option value="3">Option #3</option>
                </select>
                @if ($errors->has('unit_id'))
                  <span class="help-block">{{ $errors->first('unit_id') }}</span>
                @endif
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-2">
                <label for="detail" class=" form-control-label">Detail</label>
              </div>
              <div class="col-12 col-md-9">
                <textarea name="detail" id="detail" class="form-control {{ $errors->has('detail') ? ' is-invalid' : '' }}"></textarea>
                @if ($errors->has('detail'))
                  <span class="help-block">{{ $errors->first('detail') }}</span>
                @endif
              </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i> Submit
          </button>
          <button type="reset" class="btn btn-danger btn-sm">
            <i class="fa fa-ban"></i> Reset
          </button>
        </div>
        {!! Form::close()!!}
      </div>
    </div>
  </div>
@endSection

@section('additionalScripts')
  <script src="/vendors/datatables.net/js/jquery.dataTables.js"></script>
  <script src="/vendors/datatables.net/js/dataTables.select.min.js"></script>
  <script src="/vendors/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="/vendors/select2/js/select2.js"></script>
  <script type="text/javascript">
  (function ($) {
    $('#category_id').select2();
    $('#unit_id').select2();
  })(jQuery);
  </script>
@endSection
