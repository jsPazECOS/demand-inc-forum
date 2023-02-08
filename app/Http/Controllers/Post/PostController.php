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

    public function index(Request $request)
    {
        $this->postRepository->pushCriteria(new WithRelationshipsCriteria(['user:id,username']));
        $this->postRepository->pushCriteria(new OrderByCriteria('title', 'asc'));

        if ($request->has('filters'))
            $this->postRepository->pushCriteria(new FiltersCriteria($request->get('filters')));

        $this->postRepository->withCount(['responses']);

        return $request->has('unpaginated') ?
            $this->postRepository->all() :
            $this->postRepository->paginate(10);
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
        $post->load('user', 'responses.user');

        return Inertia::render('Post/Post/PostDetail', [
            'post' => $post
        ]);
    }

}
