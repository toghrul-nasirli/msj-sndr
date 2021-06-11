@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-2">
            <a href="{{ route('index') }}" class="btn btn-secondary py-4">
                <i class="fas fa-chevron-circle-left"></i>
            </a>
        </div>
        <div class="col-10">
            <h2>Tokeni daxil edin</h2>
        </div>
    </div>
    <form action="{{ route('changeToken') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" id="token" name="token">
        </div>

        <button class="btn btn-success" type="submit">Təsdiqlə</button>
    </form>
@endsection
