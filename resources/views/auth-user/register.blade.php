<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
    <!-- Background Image -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
        }
        .card-title {
            font-family: 'Segoe UI', sans-serif;
            font-size: 30px;
            color: #333;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 10px;
            height: 50px;
        }
        .btn-primary {
            border-radius: 10px;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
            background-color: #007bff;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .text-center {
            text-align: center;
        }
        .text-muted {
            color: #666;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                	 @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                    <h4 class="card-title">Register</h4>
                    <form action="{{ route('resigter.post') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input name="name" class="form-control" placeholder="Full name" value="{{ old('name') }}" type="text">
                            <div><span class="text-danger">@error('name') {{ $message }} @enderror</span></div> 
                        </div> 

                        <div class="form-group">
                            <input name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" type="email">
                            <div><span class="text-danger">@error('email') {{ $message }} @enderror</span></div> 
                        </div>
                        <div class="form-group">
                            <input name="password" class="form-control" placeholder="Create password" value="{{ old('password') }}" type="password">
                            <div><span class="text-danger">@error('password') {{ $message }} @enderror</span></div> 
                        </div>  
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                        </div>
                        <p class="text-center text-muted">Already have an account? <a href="{{ url('/') }}">Log In</a></p>                                                                 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
