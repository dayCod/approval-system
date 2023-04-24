@extends('layout.dashboard.master')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Consent</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Consent</li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Consent Data
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="" class="btn btn-sm btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
