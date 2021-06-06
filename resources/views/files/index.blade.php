@extends('layouts.app')

@section('content')
    @if (Session::has('done'))
        <div class="alert alert-danger">
            <h2 class="text-center"> {{ Session::get('done') }} </h2>
        </div>
    @endif
    <div class="container col-7">
        <div class="card">
            <div class="card-body">
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
                                <a href="{{ route('file.show', $data->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('file.edit', $data->id) }}" class="btn btn-primary mx-3">Edit</a>
                                <a href="{{ route('file.destroy', $data->id) }}" class="btn btn-danger mr-3">Delete</a>
                                <form method="POST" class="d-inline" action="{{ route('file.share', $data->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">share</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
