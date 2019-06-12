@extends('layouts.app')

@section('page-title')
  Edit Product Unit
@endsection

@section('additionalStyles')
  <link rel="stylesheet" href="/vendors/select2/css/select2.css">
@endSection

@section('page-name')
  <h1>Edit Product Unit</h1>
@endSection

@section('breadcrumb-list')
  <li><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ url('product-unit') }}">Product Unit</a></li>
  <li class="active">Edit</li>
@endSection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">
            Form Edit Product Unit
          </strong>
        </div>
        {!! Form::model($productUnit, ['route'=>['product-unit.update', $productUnit->id], 'class'=>'form-horizontal','id'=>'form-edit-product-unit', 'method'=>'put', 'files'=>true]) !!}
        <div class="card-body card-block">
            <div class="row form-group">
              <div class="col col-md-2">
                <label for="name" class=" form-control-label">Name</label>
              </div>
              <div class="col-12 col-md-9">
                {{ Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid':'')]) }}
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
                {{ Form::textarea('description', null, ['class' => 'form-control '.($errors->has('description') ? 'is-invalid':'')]) }}
                @if ($errors->has('description'))
                  <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
              </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i> Update
          </button>
          <a href="{{ url('product-unit/'.$productUnit->id.'') }}" class="btn btn-danger btn-sm">
            <i class="fa fa-ban"></i> Cancel
          </a>
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
    
  })(jQuery);
  </script>
@endSection
