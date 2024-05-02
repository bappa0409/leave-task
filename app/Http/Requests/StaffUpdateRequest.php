<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\SaveProfilePhotoTrait; 
use Illuminate\Support\Facades\Hash;

class StaffUpdateRequest extends FormRequest
{
    use SaveProfilePhotoTrait;

    public function rules()
    {
        return [
            'name'               => 'required',
            'email'              => 'email|required|unique:users,email,' . $this->id,
            'password'           => 'nullable|confirmed|min:6',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function update($id)
    {
        $staff = User::find($id);
        $staff->name = $this->name;
        $staff->email = $this->email;
        $staff->type = $this->type;

        if ($this->filled('password')) {
            $staff->password = Hash::make($this->password);
        }

        $staff = $this->saveProfilePhoto($this, $staff);

        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff Updated Successfully');
    }
}
