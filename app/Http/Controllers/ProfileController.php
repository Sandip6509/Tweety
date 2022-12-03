<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $tweets = $user->tweets()->withLikes()->paginate(50);
        return view('profiles.show',compact('user','tweets'));
    }

    public function edit(User $user)
    {
        return view('profiles.edit',compact('user'));
    }

    public function update(ProfileUpdateRequest $request,User $user)
    {
        $profileData =$request->except(['password_confirmation']);
        if (request()->hasFile('avatar')) {
            $imagePath = public_path('avatars/').Str::of($user->avatar)->after('http://127.0.0.1:8000/avatars/');
            if(File::exists($imagePath)){
                unlink($imagePath);
            }
            $imgName = 'avatar_' . rand() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('avatars/'), $imgName);
            $profileData['avatar'] = $imgName;
        }

        $user->update($profileData);

        return redirect($user->path());
    }
}
