<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('user')->orderByDesc('id')->get();


        return view('admin.posts.index', compact('posts'));
    }



    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'thumbnail' => 'required',
            'tags' => 'required',
        ]);

        $dataPost = $request->except(['tags', 'thumbnail']);
        if ($request->hasFile('thumbnail')) {
            $fileName = $request->thumbnail->store('thumbnails', 'public');
            $dataPost['thumbnail'] = $fileName;
        }
        $dataPost['user_id'] = auth()->user()->id;
        // dd($dataPost);
        $post = Post::create($dataPost);


        // dd($post);
        // Gắn tags nếu có
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được tạo thành công!');
    }


    public function edit(Post $post)
    {
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'thumbnail' => 'nullable',
            'tags' => 'required'
        ]);

        $dataPost = $request->except(['tags', 'thumbnail']);
        if ($request->hasFile('thumbnail')) {
            // Xóa file cũ nếu có
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
        
        
            // Lưu file mới
            $fileName = $request->thumbnail->store('thumbnails', 'public');
            $dataPost['thumbnail'] = $fileName;
        }

        $post->update($dataPost);
            $post->tags()->sync($request->tags);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}

