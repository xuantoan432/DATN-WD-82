<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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

        return view('client.blogs-details', compact('postDetail', 'blogs'));
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

    public function show($id)
    {
        $post = Post::with(['comments' => function ($query) {
            $query->where('parent_id', 0)->with('replies.user', 'user');
        }])->findOrFail(id: $id);

        return view('client.blogs-details', compact('post'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);
        $parent_id = $request->input('parent_id') ?? 0;
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id() ?: null, // Lưu user_id nếu người dùng đã đăng nhập
            'content' => $request->content,

            'parent_id' => $parent_id,
        ]);

        return redirect()->back()->with('success', 'Bình luận đã được gửi!');
    }
}
