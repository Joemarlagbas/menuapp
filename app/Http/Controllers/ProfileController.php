<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display Profile Page
     */
    public function index()
    {
        // Pinalitan ng 'profile.show' dahil nasa folder na profile ang show.blade.php
        return view('profile.show', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update Profile Information
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'   => 'nullable|string|max:20',
            'gender'  => 'nullable|in:Male,Female,Other',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Upload Avatar
     */
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {

            // Delete old avatar
            if ($user->avatar &&
                Storage::disk('public')->exists('avatar/' . $user->avatar)) {

                Storage::disk('public')->delete('avatar/' . $user->avatar);
            }

            // Store new avatar
            $file = $request->file('avatar');

            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('avatar', $filename, 'public');

            // Save filename to database
            $user->update([
                'avatar' => $filename
            ]);

            return back()->with('success', 'Avatar updated successfully!');
        }

        return back()->with('error', 'No image uploaded.');
    }
}