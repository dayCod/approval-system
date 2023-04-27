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
                        Master Department Data
                    </div>
                    <a href="{{ route('dashboard.department.create') }}" class="btn btn-sm btn-secondary">
                        <i class="fa fa-plus-circle"></i>
                        Create
                    </a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->code }}</td>
                                    <td>{{ Carbon\Carbon::parse($department->created_at)->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.department.edit', $department->id) }}" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>
                                        <a href="{{ route('dashboard.department.destroy', $department->id) }}" class="btn btn-sm btn-danger btn-delete">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
