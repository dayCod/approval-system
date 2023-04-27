@extends('layout.dashboard.master')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Master Department</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Master Department</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Edit Master Department
                        </div>
                        <a href="{{ route('dashboard.department.index') }}" class="btn btn-sm btn-secondary">
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
                        <form action="{{ route('dashboard.department.update', $department->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" name="name" id="inputName" type="text"
                                    placeholder="Dokumentasi / HR / Etc" value="{{ old('name', $department->name) }}" />
                                <label for="inputName">Name</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
