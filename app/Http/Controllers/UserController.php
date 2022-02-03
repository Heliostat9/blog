<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit()
    {
        return view('user.edit', [
            'user' => User::where('id', auth()->id())->first()
        ]);
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'avatar' => 'file'
        ]);

        if ($attributes['avatar'] ?? false) {
            $attributes['avatar'] = request()->file('avatar')->store('avatars');
        }

        $user = User::where('id', auth()->id())->first();

        $user->update($attributes);

        return back()->with('success', 'User Updated!');
    }
}
