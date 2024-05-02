<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registration Page</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/img/icons/icon-48x48.png')}}" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <div class="bg-body-tertiary min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
        
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="card-body">
                                    <h2>Registration Here</h2>
                                    <p class="text-body-secondary">Start creating the best possible user experience for you members</p>
                                    <div class="mb-3">
                                        <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Your Name" value="{{old('name')}}">
                                        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Your Email" value="{{old('email')}}">
                                        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" placeholder="Password">
                                    
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <input id="password_confirmation" class="form-control @error('password') is-invalid @enderror" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                    </div>
                                    
                                    <button class="btn btn-primary px-4 btn-block" type="submit">Sign up</button>
                                </div> 
                            </form>
                        </div>
                        <div class="card col-md-5 text-white bg-primary py-5">
                            <div class="card-body text-center">
                                <div>
                                    <h2>Login</h2>
                                    <p>Simplify your login experience with our user-friendly system. It's secure, easy to use, and ensures smooth navigation for a hassle-free journey.</p>
                                        <a href="{{route('login')}}" class="btn btn-lg btn-outline-light mt-3">Login Now!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</body>

</html>
