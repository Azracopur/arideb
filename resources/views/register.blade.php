<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INSPINIA | Register</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">IN+</h1>
        </div>
        <h3>Register to IN+</h3>
        <p>Create account to see it in action.</p>

        @if ($errors->any())
            <div class="alert alert-danger text-left">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="m-t" role="form" method="POST" action="{{ route('register.submit') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="text" name="surname" class="form-control" placeholder="Surname" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <input type="date" name="birthday" class="form-control" placeholder="Birthdate">
            </div>
            <div class="form-group">
                <div class="checkbox i-checks">
                    <label> <input type="checkbox" required> <i></i> Agree to terms and policy </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

            <p class="text-muted text-center"><small>Already have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Login</a>
        </form>

        <p class="m-t"> <small>Inspinia web app framework based on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>

<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>

</body>
</html>
