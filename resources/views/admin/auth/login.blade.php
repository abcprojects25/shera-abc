<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSRF Token -->

    <meta name="csrf-token" content="UmM818niDbZHZMiKEHvgnPCqKkXfnRnoCYVjT8er">
    <title> Admin </title>

    <link href="/favicon.ico" type="image/x-icon" rel="icon" />
    <link href="/favicon.ico" type="image/x-icon" rel="shortcut icon" />

    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
    <!-- Style css-->
    <link href="/admin/css/style.css" rel="stylesheet">
    <link href="/admin/css/colors/default.css" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript" src="/admin/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="/admin/js/bootstrap.min.js"></script>
    <style>
        .header-brand-img {
            width: 80%;
        }

        .form-control {
            height: 45px;
        }

        .ripple {
            margin-top: 30px;
        }
    </style>
</head>

<body class="main-body leftmenu">


    <div class="page main-signin-wrapper">
        <!-- Row -->
        <div class="row signpages text-center">
            <div class="col-md-12">
                <!--  To Show Alert Message -->
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="card">
                    <div class="row row-sm">
                        <div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
                            <div class="mt-5 pt-4 p-2 pos-absolute" style="margin-top:120px !important;">
                                <img src="/admin/img/logo.png" class="header-brand-img mb-4" alt="logo">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
                            <div class="container-fluid">
                                <div class="row row-sm">
                                    <div class="card-body mt-2 mb-2">
                                        <img src="/admin/img/logo.png"
                                            class=" d-lg-none header-brand-img text-left float-left mb-4" alt="logo">
                                        <div class="clearfix"></div>
                                        <form method="POST" action="{{route('adminLoginPost')}}">
                                            @csrf
                                            <h5 class="text-left mb-2">Signin to Your Account</h5>
                                            <p class="mb-4 text-muted tx-13 ml-0 text-left"></p>
                                            <div class="form-group text-left">
                                                <label>Email</label>
                                                <input class="form-control" name="email" placeholder="Enter your email"
                                                    type="text" value="{{old('email')}}">
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong> {{ $errors->first('email') }} </strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group text-left">
                                                <label>Password</label>
                                                <input class="form-control" name="password"
                                                    placeholder="Enter your password" type="password"
                                                    value="{{old('password')}}">
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong> {{ $errors->first('password') }} </strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <button class="btn ripple btn-main-primary btn-block">Sign In</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Row -->
    </div>
    <!-- End Page -->




    <div class="main-navbar-backdrop"></div>
</body>

<!-- ===== ===== -->