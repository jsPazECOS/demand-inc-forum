<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use App\Repositories\Criteria\FiltersCriteria;
use App\Repositories\Criteria\OrderByCriteria;
use App\Repositories\Criteria\WithRelationshipsCriteria;
use App\Repositories\Post\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function __construct(private PostRepository $postRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->postRepository->pushCriteria(new WithRelationshipsCriteria(['user:id,username']));
        $this->postRepository->pushCriteria(new OrderByCriteria('title'));

        if ($request->has('filters'))
            $this->postRepository->pushCriteria(new FiltersCriteria($request->get('filters')));

        $this->postRepository->withCount(['responses']);

        $posts = $request->has('unpaginated') ?
            $this->postRepository->all() :
            $this->postRepository->paginate(10);

        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'posts' => $posts->toArray()
        ]);
    }

}
