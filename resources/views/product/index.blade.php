@extends('master.master')
@section('content')
    <div class="container-fluid">
        <div class="container">
            <a href="{{ route('product.create') }}" class="link-primary">Create New</a>
            <br>
            <h1 class="mt-4">Products</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <div class="form-group">
                                    <a href="{{ url('product/edit/' . $product->id) }}"
                                        class="btn btn-primary mb-2">Edit</a>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <a href="{{ url('product/delete/' . $product->id) }}"
                                        class="btn btn-primary mb-2">Remove</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
