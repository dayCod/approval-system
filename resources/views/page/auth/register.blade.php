@extends('layout.auth.master')

@section('content')
    <div class="container">
        <div class="row align-items-center justify-content-center" style="height: 80vh">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Create Account</h3>
                    </div>
                    <div class="card-body">
                        @if(Session::has('errors'))
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('auth.register') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input name="name" class="form-control" id="inputFirstName" type="text"
                                            placeholder="Enter your first name" value="{{ old('name') }}" />
                                        <label for="inputFirstName">Full name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="email" class="form-control" id="inputEmail" type="email" placeholder="name@example.com" value="{{ old('email') }}" />
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input name="password" class="form-control" id="inputPassword" type="password"
                                            placeholder="Create a password" />
                                        <label for="inputPassword">Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="{{ route('auth.login-page') }}">Have an account? Go to login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
