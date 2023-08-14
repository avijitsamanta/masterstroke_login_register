<!DOCTYPE html>
<html>

<head>
    <title>Masterstroke</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style type="text/css">
        .login-form {
            padding-top: 5.5rem;
        }
    </style>
</head>

<body>
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if (Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} </p>
                                @endif
                                @endforeach
                            </div>

                            <form action="{{ \URL::route('user.doLogin'); }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" value="{{ Cookie::get('useremail') }}" name="email" required autofocus>
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" value="{{ Cookie::get('password') }}" required>
                                        @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="checkbox">
                                            <?php $checked = '';
                                            if (Cookie::get('remember') == 1) {
                                                $checked = 'checked';
                                            }
                                            ?>
                                            <label>
                                                <input type="checkbox" name="remember" {{$checked}}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                    <a href="{{\URL::route('user.register')}}" class="btn btn-default btn-flat red_button">
                                
                                    <button type="button" class="btn btn-primary">
                                        Signup
                                    </button>
                                    </a>

                                    <a href="{{\URL::route('user.forgotPassword')}}" class="btn btn-default btn-flat red_button">
                                        Forget Password
                                    </a>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>