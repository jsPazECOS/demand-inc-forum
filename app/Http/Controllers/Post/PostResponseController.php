<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostResponseRequest;
use App\Repositories\Criteria\OrderByCriteria;
use App\Repositories\Criteria\WhereFieldCriteria;
use App\Repositories\Criteria\WithRelationshipsCriteria;
use App\Repositories\Post\PostResponseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PostResponseController extends Controller
{
    public function __construct(private PostResponseRepository $postResponseRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $postId)
    {
        $this->postResponseRepository->pushCriteria(new OrderByCriteria('created_at', 'desc'));
        $this->postResponseRepository->pushCriteria(new WithRelationshipsCriteria(['user:id,username']));
        $this->postResponseRepository->pushCriteria(new WhereFieldCriteria('post_id', $postId));

        $postResponses = $request->has('unpaginated') ?
            $this->postResponseRepository->all() :
            $this->postResponseRepository->paginate(3);

        return $postResponses;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostResponseRequest $request, $postId)
    {
        $input = $request->validated();

        $postResponse = $this->postResponseRepository->create($input);
        $post = $postResponse->post;
        $post->load('user', 'responses.user');

        return Inertia::render('Post/Post/PostDetail', [
            'post' => $post
        ]);
    }

}
