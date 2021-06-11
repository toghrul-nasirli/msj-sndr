<div class="pb-2">
    @if (count($errors))
        <div class="alert alert-danger mb-0" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success mb-0">
            {{ session('success') }}
        </div>
    @elseif(session('warning'))
        <div class="alert alert-warning mb-0">
            {{ session('warning') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger mb-0">
            {{ session('error') }}
        </div>
    @endif
</div>
