@extends('layouts.app')
@section('title', 'Add Staff')

@push('css')
<link rel="stylesheet" href="{{asset('assets/css/image-preview.css')}}">
@endpush

@section('content')

    <!--begin::Card Header-->
    <div class="card-header mb-3">
        <div class="row">
            <div class="col-6">
                <h1 class="h3 d-inline align-middle">Update Staff Information</h1>
            </div>
            <div class="col-6 text-end">
                <a href="{{route('staff.index')}}" class="btn btn-success">
                    <i data-feather="list"></i> Staff List
                </a>
            </div>
        </div>
    </div>
    <!--end::Card Header-->

    <!--begin::Validation Message-->
    @include('include.validation-message')
    <!--end::Validation Message-->


    <div class="card">
        <form class="needs-validation" action="{{route('staff.update', $staff->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-2">
                    <label for="name" class="form-label">Staff Name<span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control" placeholder="Staff Name" name="name" required value="{{$staff->name}}">
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">Email Address<span class="text-danger">*</span></label>
                    <input type="text" id="email" class="form-control" placeholder="Staff email" name="email" required value="{{$staff->email}}">
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">Type<span class="text-danger">*</span></label>
                    <select class="form-select mb-3" name="type" required>
                        <option value="" disabled>Select Type</option>
                        <option value="1" {{$staff->type == 1 ? 'selected' : ''}}>Admin</option>
                        <option value="2" {{$staff->type == 2 ? 'selected' : ''}}>Employee</option>
                      </select>
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label">Profile Picture</label>
                    <div class="basic-image-upload">
                        <div class="image-edit">
                            <input type='file' name="profile_photo_path" id="basic-image" accept=".png, .jpg, .jpeg" />
                            <label for="basic-image">
                                <i data-feather="edit"></i>
                            </label>
                        </div>
                        <div class="image-preview">
                            <div id="image-preview"
                                style="background-image: url({{ $staff->profile_photo_path ? asset('upload/staffs/' . $staff->profile_photo_path) : asset('assets/dist/img/image-preview.png') }});"
                                class="img-fluid img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                    <input type="password" id="password" class="form-control" name="password" autocomplete="new-password">
                </div>
                <div class="mb-2">
                    <label for="password_confirmation" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" autocomplete="new-password">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
@endsection
