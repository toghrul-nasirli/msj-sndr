
@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-2">
            <a href="{{ route('index') }}" class="btn btn-secondary py-4">
                <i class="fas fa-chevron-circle-left"></i>
            </a>
        </div>
        <div class="col-10">
            <h2>Şəkil göndər</h2>
        </div>
    </div>
    <form action="{{ route('sendImage') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="numbers" name="numbers">
                <label class="custom-file-label" for="numbers">Nömrələr</label>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image">
                <label class="custom-file-label" for="image">Şəkil yükləyin</label>
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="form-label">Mesaj</label>
            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Göndər</button>
    </form>
@endsection
