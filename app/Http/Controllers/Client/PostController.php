<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPost()
    {
        $posts = Post::with(['user', 'tags'])
            ->latest()
            ->paginate(9); 

        return view('client.blogs', compact('posts'));
    }

    public function postDetail($id)
    {
        $postDetail = Post::with(['user', 'tags'])->findOrFail($id);

        $postDetail->increment('views');

        $blogs = Post::with(['user', 'tags'])
        ->latest()
        ->limit(10)
        ->get();

        return view('client.blogs-details', compact('postDetail','blogs'));
    }

    public function search(Request $request)
    {
        $key = $request->input('key');

        $searchPost = Post::with(['user.roles', 'tags'])
            ->where(function ($query) use ($key) {
                $query->where('title', 'like', "%$key%")
                    ->orWhereHas('tags', function ($query) use ($key) {
                        $query->where('name', 'like', "%$key%");
                    })
                    ->orWhereHas('user', function ($query) use ($key) {
                        $query->where('name', 'like', "%$key%");
                    })
                    ->orWhereHas('user.roles', function ($query) use ($key) {
                        $query->where('name', 'like', "%$key%");
                    });
            })
            ->get();

        return view('client.search-blogs', compact('searchPost'));
    }
}
