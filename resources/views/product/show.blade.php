@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-6 m-auto margin-tb">
        <div class="pull-left">
            <h2> Show Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('product') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6 col-sm-12 col-md-6 m-auto">
        <div class="form-group ">
            <strong>Name:</strong>
            {{ $product->name }}
        </div>
    </div>

</div>
@endsection