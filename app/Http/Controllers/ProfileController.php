<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Profile;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->first();
        $gallery = Gallery::where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(10);

        return view('profile.show', compact('user', 'gallery'));
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $socmed = [
            'Instagram' => 'instagram',
            'Facebook' => 'facebook',
            'X' => 'x',
            'Website' => 'website',
            'Tiktok' => 'tiktok',
            'Linkedin' => 'linkedin',
            'Youtube' => 'youtube',
            'Gmail' => 'gmail',
            'Github' => 'github',
        ];

        return view('profile.index', compact('user', 'socmed'));
    }

    public function update(Request $req, $id)
    {
        $user = User::findOrFail($id);

        $validate = $req->validate([
            'user_id' => 'required',
            'fullname' => 'string|max:50|min:5|nullable',
            'username' => 'string|max:8|min:3|nullable|unique:users,username,' . $user->id,
            'email' => 'string|email|nullable|unique:users,email,' . $user->id,
            'phone' => 'numeric|nullable',
            'bio' => 'string|max:15|nullable',
            'description' => 'string|max:255|nullable',
            'birthdate' => 'date|nullable',
            'gender' => 'string|nullable',
            'avatar' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
        ]);

        // Update user information
        $user->update([
            'fullname' => $validate['fullname'],
            'username' => $validate['username'],
            'email' => $validate['email'],
        ]);

        $profile = Profile::where('user_id', $user->id)->first();

        if ($profile) {
            $profile->update([
                'phone' => $validate['phone'],
                'bio' => $validate['bio'],
                'description' => $validate['description'],
                'birthdate' => $validate['birthdate'],
                'gender' => $validate['gender'],
            ]);
        } else {
            $profile = new Profile;
            $profile->user_id = $validate['user_id'];
            $profile->phone = $validate['phone'];
            $profile->bio = $validate['bio'];
            $profile->description = $validate['description'];
            $profile->birthdate = $validate['birthdate'];
            $profile->gender = $validate['gender'];
        }

        // Handle avatar update
        if ($req->hasFile('avatar')) {
            if ($profile->avatar ?? null) {
                Storage::disk('public')->delete('avatar/' . $profile->avatar);
            }

            $image = $req->file('avatar');
            $filename = $user->username . '_' . Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();
            $image->storeAs('avatar', $filename, 'public');
            $profile->avatar = $filename;
        }

        $user->save();
        $profile->save();
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }

    public function social_link(Request $request)
    {
        $userId = Auth::user()->id;
        $validate = $request->validate([
            'social_network' => 'string|required',
            'link' => 'string|required|url:https',
            'username' => 'string|nullable',
        ]);

        $validate['user_id'] = $userId;

        SocialLink::create($validate);
        return redirect()->route('profile')->with('success', 'Successfully add new social link!');
    }

    public function social_link_delete($id)
    {
        $social_link = SocialLink::where('id', $id)->first();
        $social_link->delete();
        return redirect()->back()->with('success', 'Successfully deleted social link');
    }
}
