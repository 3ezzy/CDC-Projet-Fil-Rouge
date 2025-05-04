<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'current_password' => ['nullable', 'required_with:password', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);
        
        // Update basic user information
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? $user->phone;
        
        // Update password if provided
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        
        $user->save();
        
        return back()->with('success', 'Profile updated successfully!');
    }

    public function updateAddress(Request $request)
    {
        $user = User::find(Auth::id());
        
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        
        $validated = $request->validate([
            'street_address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:2'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);
        
        // Assign properties directly
        $user->street_address = $validated['street_address'];
        $user->city = $validated['city'];
        $user->state = $validated['state'];
        $user->postal_code = $validated['postal_code'];
        $user->country = $validated['country'];
        $user->phone = $validated['phone'];
        
        $user->save();
        
        return redirect()->back()->with('success', 'Shipping address updated successfully!');
    }
} 