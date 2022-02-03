<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FavoriteController extends Controller
{
    public function index()
    {
        $posts = User::with('favorites')->where('id', auth()->id())->first()->favorites()->paginate(50);

        return view('favorite.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'post_id' => [
                'required',
                Rule::exists('posts', 'id')
            ]
        ]);

        Favorite::create(array_merge($attributes, [
            'user_id' => auth()->id()
        ]));

        return back()->with('success', 'Added in favorites post');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'post_id' => [
                'required',
                Rule::exists('posts', 'id')
            ]
        ]);

        Favorite::where([
           'user_id' => auth()->id(),
           'post_id' =>  $request->input('post_id')
        ])->delete();

        return back()->with('success', "Delete from favorites post");
    }
}
