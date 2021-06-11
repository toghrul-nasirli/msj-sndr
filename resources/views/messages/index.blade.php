@extends('layouts.app')

@section('content')
    <form action="{{ route('send') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="numbers" name="numbers">
                <label class="custom-file-label" for="numbers">Nömrələr</label>
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="form-label">Mesaj</label>
            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Göndər</button>
    </form>
    <a href="{{ route('list') }}" class="btn btn-danger btn-block mt-2">Növbədə olan mesajlar</a>
    <a href="{{ route('showImageForm') }}" class="btn btn-light btn-block mt-2">Şəkil göndər</a>
    <a href="{{ route('showVideoForm') }}" class="btn btn-light btn-block mt-2">Video göndər</a>
@endsection