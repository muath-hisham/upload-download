@extends('layouts.app')

@section('content')
    <div class="container col-7">
        <div class="card">
            <div class="card-body">
                <h1 class="text text-primary text-center display-4">Welcome to public Files</h1>
                <table class="table table-info table-hover text-center">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($files as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->title }}</td>
                            <td>
                                <a href="{{ route('file.showPublic', $data->id) }}" class="btn btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
