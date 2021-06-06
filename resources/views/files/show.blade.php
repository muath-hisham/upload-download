@extends('layouts.app')

@section('content')
    <div class="container col-3">
        <div class="card">
            <div class="card-body">
                <div class="card text-center" style="width: 100%;">
                    <img src="{{ asset('files/'.$file->file) }}" class="card-img-top" alt="{{ $file->file }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $file->title }}</h4>
                        <p class="card-text">{{ $file->des }}</p>
                        <a href="{{ route('file.download', $file->id) }}" class="btn btn-success btn-block"> Downlode </a>
                        <a href="{{ route('files') }}" class="btn btn-primary btn-block">back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
