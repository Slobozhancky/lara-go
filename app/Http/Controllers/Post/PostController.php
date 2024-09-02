<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Mockery\Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $title = 'Posts page';
//        $posts = Post::query()->get()->toArray();
//        return view('post/index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        Post::query()->create([
            'title' => 'new title 2 Eloquent ORM',
            'slug' => 'new title slug 3 Eloquent ORM',
            'content' => 'new title content Eloquent ORM',
            'category_id' => rand(1,2)
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Post::query()->create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->input('content'),
            'category_id' => $request->category_id
        ]);

        return $request->all();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('post.edit', ['title' => 'Edit page', 'post_id' => "$id"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Post::query()->where('id', $id)->update($request->all());
        return 'OK';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Post::destroy($id);
    }
}
