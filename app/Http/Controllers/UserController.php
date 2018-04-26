<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    private $rule = [
        'name'=>'required|max:30|min:4',
        'email'=>'required|email|unique:users',
        'password' => 'required|min:8'
    ];

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.users.index', [ 'users' => $users ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create');
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
        $user = User::create($request->all());

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
        $user->tags()->sync($tagIds);

        return redirect()->route('users.index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $tags = $user->tags()->get();
        return view('admin.users.edit', [
            'user' => $user,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Alter update route
        $updateRule = $this->rule;
        $updateRule['email'] = $updateRule['email'] . ',email,' . $id;
        $updateRule['password'] = 'nullable|min:8';

        $this->validate($request, $updateRule);

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if($request->has('password'))
            $user->password = $request->get('password');

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

        $user->save();
        // Now sync tags
        $user->tags()->sync($tagIds);


        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->posts()->delete();
        User::destroy($id);
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }
}
