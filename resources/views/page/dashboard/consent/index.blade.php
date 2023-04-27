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
                        Master Leave Type Data
                    </div>
                    <a href="{{ route('dashboard.consent.create') }}" class="btn btn-sm btn-secondary">
                        <i class="fa fa-plus-circle"></i>
                        Create
                    </a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consents as $consent)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $consent->name }}</td>
                                <td>{{ Carbon\Carbon::parse($consent->created_at)->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('dashboard.consent.edit', $consent->id) }}" class="btn btn-sm btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('dashboard.consent.destroy', $consent->id) }}" class="btn btn-sm btn-danger btn-delete">
                                        <i class="fa fa-trash"></i>
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
