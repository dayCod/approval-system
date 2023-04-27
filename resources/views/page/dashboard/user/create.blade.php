@extends('layout.dashboard.master')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Master User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Master User</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Create Master User
                        </div>
                        <a href="{{ route('dashboard.user.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                    <div class="card-body">
                        @if(Session::has('errors'))
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('dashboard.user.store') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" name="name" id="inputName" type="text"
                                    placeholder="John Doe" value="{{ old('name') }}" />
                                <label for="inputName">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="email" id="inputEmail" type="email"
                                    placeholder="name@example.com" value="{{ old('email') }}" />
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="password" id="inputPassword" type="password"
                                    placeholder="Password" />
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
