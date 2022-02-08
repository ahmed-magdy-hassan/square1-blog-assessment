<?php

namespace App\Http\Controllers\Web;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Web\Post\StorePostRequest;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])
            ->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.posts.index');
    }

    /**
     * Display a item of the resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (!Gate::allows('show-post', $post)) {
            abort(403);
        }

        return view('web.posts.show', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Web\Post\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        auth()->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'publication_date' => $request->publication_date,
        ]);

        return redirect()->route('posts.index');
    }
}
