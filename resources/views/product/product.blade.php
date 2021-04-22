@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <a href="{{route('product.create')}}" class="btn btn-primary mb-4 text-center">Create</a>
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>

                        <td>
                            <form action="{{ route('product.destroy',$product->id) }}" method="POST">

                                <a class="btn btn-info" href="{{ route('product.show',$product->id) }}">Show</a>

                                <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="" id="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#delete", function() {
        var $ele = $(this).parent().parent();
        var id = $(this).val();
        var url = "{{URL('products/destroy')}}";
        var dltUrl = url + "/" + id;
        $.ajax({
            url: dltUrl,
            type: "DELETE",
            cache: false,
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    $ele.fadeOut().remove();
                }
            }
        });
    });
</script>

@endsection