<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Attribute;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'attributes' => Attribute::all(),
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

    /**
     * Update the specified resource in storage.
     */
    public function update_attributes(Request $request)
    {
        $errors = $this->validate_attributes($request->input('attributes'));
        if ($errors) {
            return back()->withErrors($errors)->withInput();
        }

        $user = $request->user();
        $user->attributes()->sync($request->input('attributes'));

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Validate attributes selection.
     * 
     * @param array $attributes selection of attribute
     * 
     * @return array Array of error messages
     */
    private function validate_attributes($attributes)
    {
        $errors = array();

        if (!is_array($attributes) || empty($attributes)) {
            $errors[] = ["Select at least one prefference for each."];
            return $errors;
        }

        $attributetype_count = [
            'role' => 0,
            'industry' => 0,
            'skill' => 0
        ];

        foreach ($attributes as $attribute) {
            $attribute = Attribute::find($attribute);
            if ($attribute) {
                $attributetype_count[$attribute->attributetype] += 1;
            }
        }

        if ($attributetype_count['role'] < 1) {
            $errors['role'] = ["At least one role must be selected."];
        }
        if ($attributetype_count['industry'] < 1) {
            $errors['industry'] = ["At least one industry must be selected."];
        }
        if ($attributetype_count['skill'] < 1) {
            $errors['skill'] = ["At least one skill must be selected."];
        }

        return $errors;
    }
}
