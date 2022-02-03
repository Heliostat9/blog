<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubscribeController extends Controller
{
    public function index()
    {
        $users = Subscribe::where(['user_id' => auth()->id()])->paginate(50);

        return view('subscribe.index', [
            'authors' => $users
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'author_id' => [
                'required',
                Rule::exists('users', 'id')
            ]
        ]);

        Subscribe::create(array_merge($attributes, [
            'user_id' => auth()->id()
        ]));

        return back()->with('success', 'Your successful follow for author');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'author_id' => [
                'required',
                Rule::exists('users', 'id')
            ]
        ]);

        Subscribe::where([
            'user_id' => auth()->id(),
            'author_id' => $request->input('author_id')
        ])->delete();

        return back()->with('success', 'Your successful unfollow from author');
    }
}
