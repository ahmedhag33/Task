@extends('master.master')
@section('content')
    <div class="container-fluid">
        <div class="container">
            <h1>Create New</h1>
            <br>
            <form method="post" action=" {{ route('customer.store') }}">
                @csrf
                <div class="form-group ">
                    <input type="text" class="form-control" name="name" placeholder="Name">
                    @error('name')
                        <small class="text-muted">{{ $message }}</small>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="Address">
                    @error('address')
                        <small class="text-muted">{{ $message }}</small>
                    @enderror
                </div>
                <br>
                <div class="form-group ">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    @error('email')
                        <small class="text-muted">{{ $message }}</small>
                    @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@stop
