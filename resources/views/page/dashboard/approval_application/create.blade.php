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
                            Create Leave Request
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
                        <form action="{{ route('dashboard.approval_application.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class=" mb-3">
                                <select class="form-select" aria-label="Default select example" name="consent_id">
                                    <option value="" selected hidden>Select Consent</option>
                                    @foreach($consents as $consent)
                                    <option value="{{ $consent->id }}" @selected(old('consent_id') == $consent->id)>{{ $consent->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class=" mb-3">
                                <select class="form-select" aria-label="Default select example" name="department_id">
                                    <option value="" selected hidden>Select Department</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 d-flex flex-column">
                                <label for="formFile" class="form-label">Attachment</label>
                                <img src="" alt="" class="d-none img-thumbnail w-25 mb-3" id="showImage">
                                <input class="form-control" type="file" id="image" name="evidence_img" value="{{ old('evidence_img') }}">
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" value="0" name="need_remark">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="need_remark" value="1">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">With Remark</label>
                                </div>
                            </div>

                            <div class="mb-3 d-none" id="remark">
                                <label for="exampleFormControlTextarea1" class="form-label">Remark</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remark"></textarea>
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


@push('script')

<script>
    $(document).ready(function () {
        $('input[name="need_remark"]').change(function() {
            if ($(this).is(':checked')) {
                $('#remark').removeClass('d-none')
            } else {
                $('#remark').addClass('d-none')
            }
        })
    })
</script>

@endpush
