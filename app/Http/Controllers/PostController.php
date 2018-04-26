<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{


    private $rule = [
        'title'=>'required|max:80|min:4'
    ];

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays the welcome splash
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome(){
        return view('admin.welcome');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.posts.index', [ 'posts' => $posts ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Run validator
        $this->validate($request, $this->rule);

        // Create basic fields
        $post = new Post;
        $post->title = $request->get('title');
        $post->user()->associate(Auth::user());
        $post->save();

        // Save tags
        $tags = explode(' ', $request->get('tags'));
        $tagIds = [];

        foreach ($tags as $tag) {
            $tag = trim($tag);
            if ($tag == '')
                continue;
            $fTag = Tag::firstOrCreate( [ 'name' => $tag ] );
            $tagIds[] = $fTag->id;
        }
        // Now sync tags
        $post->tags()->sync($tagIds);

        return redirect()->route('posts.index')->with('success','Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $tags = $post->tags()->get();
        return view('admin.posts.edit', [
            'post' => $post,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Alter update route
        $this->validate($request, $this->rule);

        $post = Post::findOrFail($id);
        $post->title = $request->get('title');

        // Save tags
        $tags = explode(' ', $request->get('tags'));
        $tagIds = [];

        foreach ($tags as $tag) {
            $tag = trim($tag);
            if ($tag == '')
                continue;
            $fTag = Tag::firstOrCreate( [ 'name' => $tag ] );
            $tagIds[] = $fTag->id;
        }

        $post->save();
        // Now sync tags
        $post->tags()->sync($tagIds);


        return redirect()->route('posts.index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Post::destroy($id);
        return redirect()->route('posts.index')->with('success','Post deleted successfully');
    }
}
