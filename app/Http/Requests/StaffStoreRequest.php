<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Notifications\EmployeeCreateNotification;
use App\Notifications\LeaveRequestStatusNotification;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\SaveProfilePhotoTrait; 
use Illuminate\Support\Facades\Hash;

class StaffStoreRequest extends FormRequest
{
    use SaveProfilePhotoTrait;

    public function rules()
    {
        return [
            'name'               => 'required',
            'email'              => 'required|unique:users,email',
            'password'           => 'required|confirmed|min:6',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function store()
    {
        $staff = new User();
        $staff->name = $this->name;
        $staff->email = $this->email;
        $staff->type = $this->type;
        $staff->password = Hash::make($this->password);

        $staff = $this->saveProfilePhoto($this, $staff);

        $staff->save();

        $staff->notify(new EmployeeCreateNotification($staff));

        return redirect()->route('staff.index')->with('success', 'Staff Created Successfully');
    }
}
