<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Session\Store;

class PostController extends Controller
{
    public function getIndex ()
    {
        $posts = Post :: orderBy (' created_at ', 'desc ')-> get ();
        return view (' blog .index ', ['posts ' => $posts ]);
    }

    public function getAdminIndex ()
    {
        $posts = Post :: orderBy ('title ', 'asc ')-> get ();
        return view (' admin .index ', ['posts ' => $posts ]);
    }

    public function getPost ($id)
    {
        $post = Post :: where ('id ', $id )-> first ();
        return view (' blog .post ', ['post ' => $post ]);
    }

    public function getAdminCreate()
    {
        $tags = Tag :: all ();
        return view ('admin.create', ['tags ' => $tags ]);
    }

    public function getAdminEdit ($id)
    {
        $post = resolve('App\Post');
        $post = $post->getPost($id);
        return view('admin.edit', ['post' => $post, 'postId' => '$id']);
    }

    public function postAdminCreate ( Request $request )
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = resolve('App\Post');
        $post->addPost($request -> input('title'), $request->input('content'));

        return redirect()->route('admin.index')->with('info', 'Post Created, Title is: ' . $request->input('title'));

    }

    public function postAdminUpdate ( Request $request )
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = resolve('App\Post');
        $post->editPost($request->input('id'), $request -> input('title'), $request->input('content'));

        return redirect()->route('admin.index')->with('info', 'Post Edited, New Title is: ' . $request->input('title'));
    }
    public function getAdminDelete ( $id )
    {
        $post = Post :: find ( $id );
        $post -> likes ()-> delete ();
        $post -> tags ()-> detach ();
        $post -> delete ();
        return redirect ()-> route (' admin .index ')-> with ('info ', 'Post deleted ! ');
    }
    public function getLikePost ( $id )
    {
        $post = Post :: where ('id ', $id )-> first ();
        $like = new Like ();
        $post -> likes ()-> save ( $like );
        return redirect ()-> back ();
    }
}
