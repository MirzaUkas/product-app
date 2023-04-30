@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Product') }}</div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        @if (Auth::guard('admin')->check())
                            <a class="btn btn-primary ms-3 mt-3" href="{{ route('admin.dashboard') }}"
                                enctype="multipart/form-data">
                                Back</a>
                        @elseif(Auth::guard('user')->check())
                            <a class="btn btn-primary ms-3 mt-3" href="{{ route('products.index') }}"
                                enctype="multipart/form-data">
                                Back</a>
                        @endif
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        <input type="text" name="name" value="{{ $product->name }}"
                                            class="form-control" placeholder="Product name">
                                        @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Description:</strong>
                                        <input type="text" name="desc" class="form-control" placeholder="Description"
                                            value="{{ $product->desc }}">
                                        @error('desc')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Type:</strong>
                                        <input type="text" name="type" class="form-control" placeholder="Type"
                                            value="{{ $product->type }}">
                                        @error('type')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Stock:</strong>
                                        <input type="text" name="stock" class="form-control" placeholder="Stock"
                                            value="{{ $product->stock }}">
                                        @error('stock')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Buy Price:</strong>
                                        <input type="text" name="buy_price" class="form-control" placeholder="Buy Price"
                                            value="{{ $product->buy_price }}">
                                        @error('buy_price')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Sell Price:</strong>
                                        <input type="text" name="sell_price" class="form-control"
                                            placeholder="Sell Price" value="{{ $product->sell_price }}">
                                        @error('sell_price')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Image:</strong>
                                        <input type="file" name="image" class="form-control" placeholder="Image">
                                        <div class="mt-3">
                                            <img src="/images/{{ $product->image }}" width="150px">
                                        </div>
                                        @error('image')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
