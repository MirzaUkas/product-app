@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center gap-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        Hello Admin!

                        {{-- <div style="display:flex; flex-direction:row;">
                        <a class="btn btn-primary me-1" href="{{ route('products.index') }}" enctype="multipart/form-data">
                            Menu Produk
                        </a>
                        <a class="btn btn-primary" href="{{ route('products.index') }}" enctype="multipart/form-data">
                            Menu User
                        </a>
                    </div> --}}
                    </div>
                </div>
            </div>
            {{-- Data Produk --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Data Produk') }}</div>

                    <div class="card-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <a class="btn btn-success ms-1 mt-3 mb-3 w-25" href="{{ route('products.create') }}"
                                enctype="multipart/form-data">
                                Add
                            </a>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Stock</th>
                                    <th>Buy Price</th>
                                    <th>Sell Price</th>
                                    <th>Image</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->desc }}</td>
                                        <td>{{ $product->type }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->buy_price }}</td>
                                        <td>{{ $product->sell_price }}</td>
                                        <td><img src="/images/{{ $product->image }}" width="150px"></td>
                                        <td>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="Post">
                                                <a class="btn btn-primary"
                                                    href="{{ route('products.edit', $product->id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End of Data Produk --}}

            {{-- Data Produk --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Data User') }}</div>

                    <div class="card-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <a class="btn btn-success ms-1 mt-3 mb-3 w-25" href="{{ route('users.create') }}"
                                enctype="multipart/form-data">
                                Add
                            </a>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Alamat</th>
                                    <th>ID Card Photo</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->dob }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td><img src="/images/{{ $user->id_card_photo }}" width="150px"></td>
                                        <td>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="Post">
                                                <a class="btn btn-primary"
                                                    href="{{ route('users.edit', $user->id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End of Data Produk --}}

        </div>
    @endsection
