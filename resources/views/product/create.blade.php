@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-4 m-auto margin-tb">
        <div class="pull-left">
            <h2>{{ isset($product)?'Update':'Add New'}} Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('product') }}"> Back</a>
        </div>


        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ isset($product)?route('product.update',$product->id): route('product.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{$product->name ?? ''}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection