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
                            Edit Leave Request
                        </div>
                        <a href="{{ route('dashboard.approval_application.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                    <div class="card-body">
                        @if (Session::has('errors'))
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('dashboard.approval_application.update', $approval_applications->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class=" mb-3">
                                <select class="form-select" aria-label="Default select example" name="consent_id">
                                    <option value="" selected hidden>Select Consent</option>
                                    @foreach($consents as $consent)
                                    <option value="{{ $consent->id }}" @selected(old('consent_id', $approval_applications->consent_id) == $consent->id)>{{ $consent->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class=" mb-3">
                                <select class="form-select" aria-label="Default select example" name="department_id">
                                    <option value="" selected hidden>Select Department</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}" @selected(old('department_id', $approval_applications->department_id) == $department->id)>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 d-flex flex-column">
                                <label for="formFile" class="form-label">Evidence Image</label>
                                <img src="{{ asset($approval_applications->evidence_img) }}" alt="" class="img-thumbnail w-25 mb-3" id="showImage">
                                <input class="form-control" type="file" id="image" name="evidence_img" value="{{ old('evidence_img') }}">
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" value="0" name="need_remark">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="need_remark" value="1" @checked(old('need_remark', $approval_applications->need_remark) == 1)>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">With Remark</label>
                                </div>
                            </div>

                            <div class="mb-3 {{ is_null($approval_applications->remark) ? 'd-none' : '' }}" id="remark">
                                <label for="exampleFormControlTextarea1" class="form-label">Remark</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remark">{{ $approval_applications->remark }}</textarea>
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


@push('script')

<script>
    $(document).ready(function () {
        $('input[name="need_remark"]').change(function() {
            if ($(this).is(':checked')) {
                $('#remark').addClass('d-none')
                $('#remark').removeClass('d-none')
            } else {
                $('#remark').removeClass('d-none')
                $('#remark').addClass('d-none')
            }
        })
    })
</script>

@endpush
