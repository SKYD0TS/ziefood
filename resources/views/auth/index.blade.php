<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Login caffe</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="{{ asset('assets') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- NProgress -->
    <link href="{{ asset('assets') }}/vendors/nprogress/nprogress.css" rel="stylesheet" />
    <!-- Animate.css -->
    <link href="{{ asset('assets') }}/vendors/animate.css/animate.min.css" rel="stylesheet" />

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets') }}/build/css/custom.min.css" rel="stylesheet" />
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="{{ route('cekLogin')}}" method="post" novalidate>
                        @csrf
                        <h1>Login</h1>
                        <div>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email')}}" placeholder="Email" required="" />
                            <!-- <input type="text" class="form-control" placeholder="Username" name="email" id="email" required=""> -->
                        </div>
                        <div>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password')}}" required="">
                            <!-- <input type="password" class="form-control" placeholder="password" name="password" id="password" required=""> -->
                        </div>
                        @error('notfound')
                        <div class="row mb-2">
                            <div class="col-12 text-center text-danger">
                                {{ $message }}
                            </div>
                        </div>
                        @enderror
                        <div>
                            <div>
                                <button class="btn btn-default submit">Log in</button>
                                <a class="reset_pass" href="#">Lost your password?</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">
                                    New to site?
                                    <a href="#signup" class="to_register">
                                        Create Account
                                    </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1>
                                        <i class="fa fa-coffee"></i> Zie Caffe
                                    </h1>
                                    <p>
                                        ©2016 All Rights Reserved. Gentelella
                                        Alela! is a web .
                                        Privacy and Terms
                                    </p>
                                </div>
                            </div>
                    </form>
                </section>
            </div>

            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form action="{{ route('cekLogin')}}" method="post" novalidate>
                        @csrf
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" @error('email') is-invalid @enderror name="email" id="email" value="{{ old('email')}}" placeholder="Email" required="" />

                            <div class="input-group-append">
                                <div class="input-group-text">
                                </div>
                            </div>

                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="input-group mb-3">
                            <input type="password" class="form-control" @error('password') is-invalid @enderror placeholder="Password" name="password" value="{{ old('password')}}" required="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                </div>
                            </div>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        @error('notfound')
                        <div class="row mb-2">
                            <div class="col-12 text-center text-danger">
                                {{ $message }}
                            </div>
                        </div>
                        @enderror
                        <div>
                            <a class="btn btn-default submit" href="index.html">Submit</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">
                                Already a member ?
                                <a href="#signin" class="to_register">
                                    Log in
                                </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1>
                                    <i class="fa fa-coffee"></i> Gentelella
                                    Alela!
                                </h1>
                                <p>
                                    ©2024 All Rights Reserved. Gentelella
                                    Alela! is a Web .
                                    Privacy and Terms
                                </p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>