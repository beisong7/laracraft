<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Login">
    <meta name="author" content="synergy node - synergynode.com">

    <title>Admin Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-6 col-md-6">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                            <p class="text-center">Admin</p>
                        </div>
                        <form class="user" method="post" action="{{ route('reset.lost.pass', [$user->uuid, $user->reset_token]) }}">
                            {{ csrf_field() }}
                            <br>
                            <div class="form-group mb-4">
                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Password..." autocomplete="off">
                            </div>
                            <br>

                            <div class="form-group mb-4">
                                <input type="password" name="confirm_password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Confirm Password..." autocomplete="off">
                            </div>
                            <br>

                            <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button>
                            <br>
                            @include('layouts.notice')
                        </form>
                        <hr>
                        <br>
                        <div class="text-center">
                            <a class="small" href="{{ route('cms.signin') }}">Try Login</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
