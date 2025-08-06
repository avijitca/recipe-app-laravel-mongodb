<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            height: 40vh;
            /* Full viewport height */
        }
    </style>
</head>

<body class="bg-light">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-8 text-center">
                <h1 class="display-7">Recipe App</h1>
                <div class="col-sm-12">
                    <h4>Login</h4>
                     @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <form name="crud_form" method="post" action="{{ route('login.submit') }}">
                        @csrf
                        <table class="table">
                            <tr>
                                <td><b>Email:</b></td>
                                <td><input type="text" name="email" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><b>Password:</b></td>
                                <td><input type="password" name="password" class="form-control"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="submit" class="btn btn-dark form-control" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @php
    //    $test ='how fine it is @!'.'<br>';
    //  echo $test.'Testing how PHP code works in a blde!';
    @endphp
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>