@extends('master.master')
@section('content')
    <div class="container-fluid">
        <div class="container">
            <h1>Edit</h1>
            <br>
            <form method="post" action="{{ route('product.update', $products->id) }}">
                @csrf
                <div class="form-group ">
                    <input type="text" class="form-control" name="name" value="{{ $products->name }}"
                        placeholder="Name">
                    @error('name')
                        <small class="text-muted">{{ $message }}</small>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <input type="text" class="form-control" name="price" placeholder="price"
                        value="{{ $products->price }}">
                    @error('price')
                        <small class="text-muted">{{ $message }}</small>
                    @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@stop
