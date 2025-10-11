<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Helpers\UploadController;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $helpers;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->helpers = new UploadController();
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        if (Auth::user()->role->name == 'Anggota Perpustakaan') {
            $updateRoute = 'anggota.profile.update';
        } elseif (Auth::user()->role->name == 'Operator Perpustakaan') {
            $updateRoute = 'operator.profile.update';
        } else {
            $updateRoute = 'admin.profile.update';
        }
        return view('profile.edit', compact('user', 'updateRoute'));
    }

    /**
     * Update the profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $request->validate([
                'current_password' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak cocok.']);
            }

            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            // Upload new image
            $image = $request->file('image');
            $location = 'assets/images/profiles/';
            $user->image = $this->helpers->imageUpload($image, $location);
        }

        $user->save();

        if (Auth::user()->role->name == 'Anggota Perpustakaan') {
            $route = 'anggota.profile.edit';
        } elseif (Auth::user()->role->name == 'Operator Perpustakaan') {
            $route = 'operator.profile.edit';
        } else {
            $route = 'admin.profile.edit';
        }
        return redirect()->route($route)->with('success', 'Profile updated successfully.');
    }
}
