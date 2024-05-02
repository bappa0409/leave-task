@extends('layouts.app')
@section('title', 'Leave Request')

@push('css')
@endpush
@section('content')

    <!--begin::Card Header-->
    <div class="card-header mb-3">
        <div class="row">
            <div class="col-6">
                <h1 class="h3 d-inline align-middle">Leave Request Form</h1>
            </div>
            <div class="col-6 text-end">
                <a href="{{route('leave_request.index')}}" class="btn btn-success">
                    <i data-feather="list"></i> Leave Request List
                </a>
            </div>
        </div>
    </div>
    <!--end::Card Header-->

    <!--begin::Validation Message-->
    @include('include.validation-message')
    <!--end::Validation Message-->


    <div class="card">
        <form class="needs-validation" action="{{route('leave_request.store')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="mb-2">
                    <label class="form-label">Leave Type<span class="text-danger">*</span></label>
                    <select class="form-select mb-3" name="leave_type" required>
                        <option selected disabled value="">Select Type</option>
                        <option value="1">Casual Leave</option>
                        <option value="2">Sick Leave</option>
                        <option value="3">Emergency Leave</option>
                      </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Leave Start Date To End Date<span class="text-danger">*</span></label>
                    <input type="text" class="form-control date-range" name="leave_date_range" required autocomplete="off">
                </div>
                <div class="mb-2">
                    <label class="form-label">Reason</label>
                    <textarea class="form-control" name="reason" cols="30" rows="5"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
@endsection
