@extends('master.master')
@section('content')
    <div class="container-fluid">
        <center>
            <h1>Invoice Report</h1>
        </center>
        {{-- <form action=""> --}}
        @if (session('invoice'))
            @foreach (session('invoice') as $id => $details)
                <div class="form-group ">
                    <span><b>Customer Id:</b></span>
                    <label for="">{{ $id }}</label>
                </div>
                <div class="form-group ">
                    <span><b>Customer Name:</b></span>
                    <label for="">{{ $details['customer_name'] }}</label>
                </div>
                <div class="form-group ">
                    <span><b>Invoice No:</b></span>
                    <label for="">{{ $details['invoice_no'] }}</label>
                </div>
                <div class="form-group ">
                    <span><b>Invoice Date:</b></span>
                    <label for="">{{ $details['invoice_data'] }}</label>
                </div>
            @endforeach
        @endif
        <hr>
        <br>
        @if (count((array) session('invoicedetails')) >= 1)
            @php $total = 0 @endphp
            <table id="invoicedetail" class="table">
                <thead>
                    <tr>
                        {{-- <th scope="col">Id</th> --}}
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th>Price</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if (session('invoicedetails'))
                        @foreach (session('invoicedetails') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr data-id="{{ $id }}">
                                {{-- <th scope="row">{{ $product->id }}</th> --}}
                                <td data-th="Product">{{ $details['product_name'] }}</td>
                                <td>
                                    <input type="number" value="{{ $details['quantity'] }}"
                                        class="form-control quantity update-invoicedetails" />
                                </td>
                                <td>{{ $details['price'] }}</td>
                                <td data-th="Subtotal" class="text-center">
                                    ${{ $details['subtotal'] = $details['price'] * $details['quantity'] }}</td>
                            </tr>
                        @endforeach
                        Total :{{ $total }}
                    @endif
                </tbody>
            </table>
        @endif
        <a href="{{ route('store.invoicedetails') }}" class="btn btn-danger">Save</a>
        {{-- </form> --}}
    </div>
@section('scripts')
    <script type="text/javascript">
        $(".update-invoicedetails").change(function(e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('update.invoicedetails') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
    </script>
@stop

@stop
