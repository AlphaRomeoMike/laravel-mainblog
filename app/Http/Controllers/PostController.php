<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::with(['user']);
        return view('posts.index', ['data' => Post::paginate(5)]);
    }
}
