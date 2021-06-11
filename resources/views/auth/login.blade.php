<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Msj Sndr</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .center {
            position: absolute;
            left: 50%;
            top: 60%;
            transform: translate(-50%, -50%);
            width: 90%;
            height: 90%;
            overflow-y: hidden;
        }
    </style>
</head>

<body class="hold-transition login-page center">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="E-poçt ünvanı" class="form-control @error('email') is-invalid @enderror">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" placeholder="Şifrə" class="form-control @error('password') is-invalid @enderror">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Daxil ol</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
