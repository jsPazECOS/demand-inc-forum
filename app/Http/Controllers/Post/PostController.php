<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Models\Post\Post;
use App\Repositories\Criteria\FiltersCriteria;
use App\Repositories\Criteria\OrderByCriteria;
use App\Repositories\Criteria\WithRelationshipsCriteria;
use App\Repositories\Post\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

class PostController extends Controller
{

    public function __construct(private PostRepository $postRepository)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->validated();

        $post = $this->postRepository->create($input);

        return redirect(route('home.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $postId)
    {
        $post = $this->postRepository->find($postId);
        $post->load('responses.user');

        return Inertia::render('Post/PostDetail', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
