@extends('master.master')
@section('content')
    <a href="{{ route('sales.create') }}" class="btn btn-danger">Invoice Report</a>
    <h1 class="mt-4">Products</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th>Add To Invoice</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <div class="text-center"><a class="btn btn-danger" product_id="{{ $product->id }}"
                                id="add_btn">Add to
                                Invoice</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <span class="badge bg-dark text-white ms-1 rounded-pill">{{ count((array) session('invoicedetails')) }}</span>
@section('scripts')
    <script>
        $(document).on('click', '#add_btn', function(e) {
            e.preventDefault();
            var product_id = $(this).attr('product_id');
            $.ajax({
                type: 'post',
                url: "{{ route('add.invoicedetails') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': product_id
                },
                success: function(response) {
                    window.location.reload();

                }
            });
        });
    </script>
@stop
@stop
