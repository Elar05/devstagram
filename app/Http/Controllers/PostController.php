<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->paginate(3);

        return view('dashboard', ['user' => $user, 'posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required',
            'description' => 'required',
            'imagen' => 'required',
        ]);

        // 1
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'description' => $request->description,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        // 2
        // $post = new Post();
        // $post->titulo = $request->titulo;
        // $post->description = $request->description;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // 3
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'description' => $request->description,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->user);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', ["post" => $post, "user" => $user]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        $img_path = public_path('uploads/' . $post->imagen);

        if (File::exists($img_path)){
            unlink($img_path);
            // File::delete($img_path);
        }

        return redirect()->route('posts.index', auth()->user()->user);
    }
}
