<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        return view("posts.index", [
            'posts' => Post::latest()->published()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        Post::where('id', $post->id)
            ->update(['views_count' => $post->views_count + 1]);

        return view("posts.show", [
            'post' => $post
        ]);
    }


}
