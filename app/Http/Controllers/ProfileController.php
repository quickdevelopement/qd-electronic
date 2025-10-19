<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateProfileInformation(Request $request){

        $request->validate([
            'name'=> ['required', 'string', 'max:255'],
            'bio'=> ['nullable', 'string', 'max:255'],
            'phone'=> ['nullable', 'string', 'max:15'],

        ]);

        $user = Auth::user();

        if(!$user instanceof \App\Models\User){
            $user = User::find($user->id);
        }

        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->phone = $request->phone;

        $user->save();
        flash()->success('Profile updated successfully.');

        return Redirect::route('profile');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function avatar(): View
    {
        return view('profile.edit-avatar', [
            'user' => Auth::user(),
        
        ]);
    }

    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        if (!$user instanceof \App\Models\User) {
            $user = User::find($user->id);
        }

        if (isset($request->image)) {
            $avatar = $request->image;
            // user first part 
            $filename = substr($user->name, 0) . '.' . time() . '.' . $avatar->getClientOriginalExtension();

            // already store avatar
            if($user->avatar && file_exists(public_path('avatar/' . $user->avatar))){
                unlink(public_path('avatar/' . $user->avatar));
            }

            $avatar->move(public_path('avatar'), $filename);

            // If you want to delete the old avatar, uncomment the following lines
            // if ($user->avatar) {
            //     Storage::delete('public/' . $user->avatar);
            // }

            $user->avatar = $filename;
            $user->save();

            flash()->success('Avatar updated successfully!');
            return Redirect::route('profile');
        }else{
            flash()->error('Please select an image to upload.');
            return Redirect::route('profile');
        }
    }
}
