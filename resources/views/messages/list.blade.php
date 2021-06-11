@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-2">
            <a href="{{ route('index') }}" class="btn btn-secondary py-4">
                <i class="fas fa-chevron-circle-left"></i>
            </a>
        </div>
        <div class="col-10">
            @if (count($data) > 0)
                <h2>Növbədə olan mesajlar!</h2>
            @else
                <h2>Növbədə olan mesajınız yoxdur!</h2>
            @endif
        </div>
    </div>
    <ul class="list-group">
        @foreach ($data as $item)
            <li class="list-group-item">
                <div class="row justify-content-between px-3">
                    <span>0{{ substr($item['phone'], 4) }}|{{ $item['message'] }}</span>
                    <form action="{{ route('delete', $item['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border-0 bg-transparent"><i class="fas fa-times"></i></button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
