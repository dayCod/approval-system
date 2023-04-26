@extends('layout.dashboard.master')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Approval Application</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Approval Application</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Approval Application Data
                        </div>
                        <a href="{{ route('dashboard.approval_application.create') }}" class="btn btn-sm btn-secondary">
                            <i class="fa fa-plus-circle"></i>
                            Create
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Consent</th>
                                    <th>Departement</th>
                                    <th>Image</th>
                                    <th>Remark</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approval_applications as $approval_application)
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $approval_application->consent->name }}
                                    </td>
                                    <td>
                                        {{ $approval_application->department->name }}
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Show Image
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Evidence Image</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset($approval_application->evidence_img) }}" class="img-thumbnail w-50" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $approval_application->need_remark ? $approval_application->remark : 'Without Remark' }}
                                    </td>
                                    <td>
                                        {{ $approval_application->created_at }}
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.approval_application.edit', $approval_application->id) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('dashboard.approval_application.destroy', $approval_application->id) }}"
                                            class="btn btn-sm btn-danger btn-delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
