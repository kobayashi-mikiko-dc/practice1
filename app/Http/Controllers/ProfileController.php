<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Lib\MyFunction;


class ProfileController extends Controller
{

    /**
     * Display the user's profile form.
     */

    public function edit(Request $request, $id): View
    {
        //dd($id);
        $user = User::findOrFail($id);
        //return view('profile.edit', ['user'=>$user]);
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, User $user)
    {
        
        $validated = $request->validate([
            
            'surname' => ['required', 'string', 'max:255'],
            'given_name' => ['required', 'string', 'max:255'],
            'image_file_name'=>['required', 'file', 'mimes:jpeg,png', 'max:1000'], //kb
            'birth_day'=>['required', 'date', 'before:today'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
           
        ]);
        
        $user->update($validated);
        $request->session()->flash('message', '更新しました');
        return back; 
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
