<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid h-100 d-flex justify-content-center align-items-center" style="margin-top:50px;">
        <div class="col-sm-6 col-md-4 border" style="margin:10px;">
            <div class="text-center">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}"  class= " img-fluid mx-auto h-75 w-75" />
            </div>
            <h1 class="mb-4 text-center">Login</h1>

            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
            
                <div class="form-group">
                    <label for="email">Username</label>
            
                    <div>
                        <input id="email"  name="username"  required autofocus class="form-control">
                    </div>
                </div>
            
                <div class="form-group">
                    <label for="password">Password</label>
            
                    <div>
                        <input id="password" type="password" name="password" required class="form-control">
                    </div>
                </div>
            
                <div>
                    <div style="margin:10px;">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
						<a href="{{ route('vregister') }}"> Register Here </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNSLZ+9" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
