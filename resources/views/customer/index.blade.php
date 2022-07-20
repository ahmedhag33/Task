@extends('master.master')
@section('content')
    <div class="container-fluid">
        <div class="container">
            <a href="{{ route('customer.create') }}" class="link-primary">Create New</a>
            <br>
            <h1 class="mt-4">Customers</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Remove</th>
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
                                <div class="form-group">
                                    <a href="{{ url('customer/edit/' . $customer->id) }}"
                                        class="btn btn-primary mb-2">Edit</a>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <a href="{{ url('customer/delete/' . $customer->id) }}"
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
