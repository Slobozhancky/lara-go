<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'Admin STORE post action';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Admin SHOW post - {$id}";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "Admin page. I want edit post with id - {$id}";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "Admin page. I want UPDATE post with id - {$id}, when was i get with action EDIT";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "Admin page. I want DELETE post with id - {$id}";
    }
}
