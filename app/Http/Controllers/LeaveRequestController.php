<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveStoreRequest;
use App\Http\Requests\LeaveUpdateRequest;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Notifications\LeaveRequestStatusNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveRequests = [];

        if(Auth::user()->type == 1){
            LeaveRequest::with('user')->orderBy('id', 'desc')->chunk(100, function ($leave_requests) use (&$leaveRequests) {
                foreach ($leave_requests as $leave_request) {
                    $leaveRequests[] = $leave_request;
                }
            });
        }else{
            LeaveRequest::with('user')->where('user_id', Auth::id())->orderBy('id', 'desc')->chunk(100, function ($leave_requests) use (&$leaveRequests) {
                foreach ($leave_requests as $leave_request) {
                    $leaveRequests[] = $leave_request;
                }
            });
        }
        
        return view('leave-request.index', compact('leaveRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leave-request.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveStoreRequest $request)
    {
        return $request->store();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        return view('leave-request.edit', compact('leaveRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveUpdateRequest $request, string $id)
    {
        return $request->update($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->delete();
        return response()->json(['success' => 'success']);
    }

    /**
     * Leave Request Approve
     */
    public function approve(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::with('user')->findOrFail($id);
        $leaveRequest->comment = $request->comment;
        $leaveRequest->status = 'approve';
        $leaveRequest->save();

        $leaveRequest->user->notify(new LeaveRequestStatusNotification($leaveRequest));
        return response()->json(['success' => 'success']);
    }

    /**
     * Leave Request Cancel
     */
    public function cancel(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::with('user')->findOrFail($id);
        $leaveRequest->comment = $request->comment;
        $leaveRequest->status = 'cancel';
        $leaveRequest->save();

        $leaveRequest->user->notify(new LeaveRequestStatusNotification($leaveRequest));
        return response()->json(['success' => 'success']);
    }

}
