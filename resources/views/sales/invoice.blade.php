@extends('master.master')
@section('content')
    <div class="container-fluid">
        <h1>Add Invoice</h1>
        <div class="form-group ">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Add To Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <th scope="row">{{ $customer->id }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>
                                <div class="text-center"><a class="btn btn-danger" customer_id="{{ $customer->id }}"
                                        id="add_btn">Add to
                                        Invoice</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="text-center"><a class="btn btn-danger" book_id="{{ $book->id }}"
                id="add_btn">Add to
                cart</a>
        </div> --}}
        </div>
        <br>
        <span class="badge bg-dark text-white ms-1 rounded-pill">{{ count((array) session('invoice')) }}</span>
    </div>
@section('scripts')
    <script>
        $(document).on('click', '#add_btn', function(e) {
            e.preventDefault();
            var customer_id = $(this).attr('customer_id');
            $.ajax({
                type: 'post',
                url: "{{ route('add.invoice') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': customer_id
                },
                success: function(response) {
                    // window.location.reload();
                    window.location.href = "{{ route('sales.invoicedetails') }}";
                }
            });
        });
    </script>
@stop
@stop
