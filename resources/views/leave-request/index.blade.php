@extends('layouts.app')
@section('title', 'Leave Requests')

@push('css')
@endpush
@section('content')

    <!--begin::Card Header-->
    <div class="card-header mb-3">
        <div class="row">
            <div class="col-6">
                <h1 class="h3 d-inline align-middle">Leave Requests</h1>
            </div>
            <div class="col-6 text-end">
                <a href="{{route('leave_request.create')}}" class="btn btn-success">
                    <i data-feather="plus-circle"></i> Create Leave Request
                </a>
            </div>
        </div>
    </div>
    <!--end::Card Header-->

    <!--begin::Validation Message-->
    @include('include.validation-message')
    <!--end::Validation Message-->


    <!--begin::Card-->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">All Leave Request Here</h5>
            <h6 class="card-subtitle text-muted">If you are an employee, then you will see only your data. If you are an admin, then you will see all the data.</h6>
        </div>
        <div class="card-body">
            <table id="dataTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Days</th>
                        <th>Reason</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Comment By Admin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaveRequests as $leaveRequest)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-light rounded-2">
                                        <img class="p-2" src="{{$leaveRequest->user?->profile_photo_path ? asset('upload/staffs/'.$leaveRequest->user?->profile_photo_path) : asset('assets/img/avatar.jpg')}}" style="height:50px; width:50px">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-1">
                                    {{ucwords($leaveRequest->user?->name)}}
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($leaveRequest->leave_type == 1)
                            <span class="badge bg-success">Casual Leave</span>
                            @elseif($leaveRequest->leave_type == 2)
                            <span class="badge bg-danger">Sick Leave</span>
                            @elseif($leaveRequest->leave_type == 3)
                            <span class="badge bg-primary">Emergency Leave</span>
                            @endif
                        </td>
                        <td>{{$leaveRequest->start_date}}</td>
                        <td>{{$leaveRequest->end_date}}</td>
                        <td>
                            @php
                                $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $leaveRequest->start_date);
                                $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $leaveRequest->end_date);
                                $totalDaysCount = abs($endDate->diffInDays($startDate)) + 1;
                            @endphp
                            {{$totalDaysCount}}
                        </td>
                        <td>{{$leaveRequest->reason}}</td>
                        <td>{{$leaveRequest->created_at->format('Y-m-d')}}</td>
                        
                        <td>
                            @if($leaveRequest->status == 'approve')
                            <span class="badge bg-success">Approved</span>
                            @elseif($leaveRequest->status == 'cancel')
                            <span class="badge bg-danger">Canceled</span>
                            @else
                            <span class="badge bg-primary">Pending</span>
                            @endif
                        </td>
                        <td>{{$leaveRequest->comment}}</td>
                        <td>
                            @if ($leaveRequest->status == 'pending')
                                <a href="{{route('leave_request.edit', $leaveRequest->id)}}" class="btn btn-primary actions btn-sm mr-1"><i data-feather="edit"></i></a>
                            @endif

                            @if (Auth::user()->type == 1)
                                @if($leaveRequest->status == 'pending')
                                    <a href="javascript:void(0)" class="btn btn-success leave-request-approve-confirm btn-sm mr-1" title="Approve" data-route="{{ route('leave_request.approve', $leaveRequest->id) }}" data-csrf="{{ csrf_token() }}">Approve</a>

                                    <a href="javascript:void(0)" class="btn btn-danger leave-request-cancel-confirm btn-sm mr-1" title="Cancel" data-route="{{ route('leave_request.cancel', $leaveRequest->id) }}" data-csrf="{{ csrf_token() }}">Cancel</a>
                                @endif
                            @endif

                            @if ($leaveRequest->status == 'pending' || Auth::user()->type == 1)
                                <a href="javascript:void(0)" class="btn btn-danger delete-confirm btn-sm" data-route="{{route('leave_request.destroy', $leaveRequest->id)}}" data-csrf="{{csrf_token()}}" title="Delete">
                                    <i data-feather="trash"></i>
                                </a>  
                            @endif
                        </td>
                    </tr>
                    @endforeach
       
                </tbody>
            </table>
        </div>
    </div>
    <!--end::Card-->
   
@endsection


