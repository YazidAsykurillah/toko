@extends('layouts.app')

@section('additionalStyles')
  <link rel="stylesheet" href="/vendors/select2/css/select2.css">
@endSection

@section('page-name')
  <h1>Create Product Unit</h1>
@endSection

@section('breadcrumb-list')
  <li><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ url('product-unit') }}">Product Unit</a></li>
  <li class="active">Create</li>
@endSection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">
            Create Product Unit Form
          </strong>
        </div>
        {!! Form::open(['route'=>'product-unit.store','role'=>'form','class'=>'form-horizontal','id'=>'form-store-product-unit','files'=>true]) !!}
        <div class="card-body card-block">
            <div class="row form-group">
              <div class="col col-md-2">
                <label for="name" class=" form-control-label">Name</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" id="name" name="name" placeholder="Product Unit name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">
                @if ($errors->has('name'))
                  <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-2">
                <label for="description" class=" form-control-label">Description</label>
              </div>
              <div class="col-12 col-md-9">
                <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"></textarea>
                @if ($errors->has('description'))
                  <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
              </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary btn-sm" id="btn-submit-product-unit">
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
  <script src="/vendors/select2/js/select2.js"></script>
  <script type="text/javascript">
  (function ($){
    $('#form-store-product-unit').on('submit', function(){
      $('#btn-submit-product-unit').prop('disabled', true);
    });
  })(jQuery);
  </script>
@endSection
