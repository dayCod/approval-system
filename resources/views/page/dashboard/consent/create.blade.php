@extends('layout.dashboard.master')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Master Leave Type</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Master Leave Type</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Create Master Leave Type
                        </div>
                        <a href="{{ route('dashboard.consent.index') }}" class="btn btn-sm btn-secondary">
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
                        <form action="{{ route('dashboard.consent.store') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" name="name" id="inputName" type="text"
                                    placeholder="Izin / Sakit / Etc" value="{{ old('name') }}" />
                                <label for="inputName">Name</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
