<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::with(['user']);
        return view('posts.index', ['data' => Post::paginate(5)]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'       => ['required', 'int'],
            'title'         => ['required', 'string'],
            'description'   => ['required', 'string']
        ]);

        $post = Post::create($data);

        if($post)
        {
            return redirect('post')->with('success', 'Post was added');
        } 
        else
        {
            return redirect('post')->with('error', 'Post was not added');
        }
    }

    public function edit($id)
    {
        $data = Post::Find($id);
        if(Auth::user()->id != $data->user_id)
        {
            return redirect('post')->with('error', 'You cannot edit this post');
        }
        else
        {
            return view('posts.edit', ['data' => $data]);
        }
    }

    public function update(Request $request, $id)
    {
        if($id != null)
        {
            $data = $request->validate([
                'user_id'       => ['required', 'numeric'],
                'title'         => ['required', 'string'],
                'description'   => ['required', 'string']
            ]);

            if(Auth::user()->id != $data['user_id'])
            {
                return redirect('post')->with('error', 'You cannot edit this post');
            }
            else
            {
                $data = Post::Where('id', '=', $id)->update($data);
                return redirect('post')->with('success', 'Post has been updated');
            }
        }
        else
        {
            return redirect('post')->with('error', 'You please edit a valid post');
        }
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        if(Auth::user()->id != $post->user_id)
        {
            return redirect('post')->with('error', 'You cannot delete this post');
        }
        else
        {
            Post::Where('id', '=', $id)->delete();
            return redirect('post')->with('success', 'Post has been deleted');
        }
    }
}
