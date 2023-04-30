@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Data Produk') }}</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a class="btn btn-success ms-1 mt-3 mb-3 w-25" href="{{ route('users.create') }}" enctype="multipart/form-data">
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
                                <th>Address</th>
                                <th>ID Card</th>
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
    </div>
</div>
@endsection
