@extends('layout.dashboard.master')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Leave Request</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Leave Request</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Leave Request Data
                        </div>
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
                                @foreach ($approval_applications as $index => $approval_application)
                                <tr>
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
                                            data-bs-target="#exampleModal{{ $index + 1 }}">
                                            Show Image
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $index + 1 }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Evidence Image</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ url($approval_application->evidence_img) }}" class="img-thumbnail w-50" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        {{ $approval_application->need_remark ? $approval_application->remark : '-' }}
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($approval_application->created_at)->format('d M Y') }}
                                    </td>
                                    <td>
                                        @if($approval_application->status == 0)
                                        <a href="{{ route('dashboard.approval.approve', $approval_application->id) }}"
                                            class="btn btn-sm btn-success approval-btn" id="approve">
                                            <i class="fa fa-check"></i>
                                            Approve
                                        </a>
                                        <a href="{{ route('dashboard.approval.reject', $approval_application->id) }}"
                                            class="btn btn-sm btn-danger approval-btn" id="reject">
                                            <i class="fa fa-close"></i>
                                            Reject
                                        </a>
                                        @else
                                        <span class="badge {{ ($approval_application->status == 1) ? 'bg-success' : 'bg-danger' }}">{{ ($approval_application->status == 1) ? 'Approved' : 'Rejected' }}</span>
                                        @endif
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
