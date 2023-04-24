@extends('layout.auth.master')

@section('content')
    <div class="container">
        <div class="row align-items-center justify-content-center" style="height: 80vh">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                    <div class="card-body">
                        <form action="{{ route('auth.login') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" value="{{ old('email') }}" />
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="{{ route('auth.register-page') }}">Need an account? Sign up!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
