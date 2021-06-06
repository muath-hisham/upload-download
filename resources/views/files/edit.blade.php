@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container col-7">
        <div class="card">
            <div class="card-body">
                <h1 class="text text-center text-primary display-4">Edit File</h1>
                <form action="{{ route('file.update' , $files->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{$files->title}}" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="des">Descripation</label>
                        <textarea name="des" id="des" class="form-control" cols="30" rows="10">{{$files->des}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" name="fileIn" id="file">
                    </div>
                    <button class="btn btn-primary btn-block my-3">Send Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
