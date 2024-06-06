<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    protected $redirectTo = '/';

    public function create(Request $request){
        //$request->validate("title" => ['required', 'string', 'max:255']);

        $input = $request->all();
       
        $post = Post::create([
            "user_id" => auth()->id(),
            "title" => $input['title'],
            "text" => $input["text"],
            "likes" => 0,
            "comments" => 0,
        ]);

        return json_encode(["hasError" => false]);
    }

    public function getById(Request $request){
        if (!$request->has("id")) {
            return json_encode(["hasError" => true, "error" => "requers id"]);
        }

        $input = $request->all();
        $posts = Post::where('user_id', $input["id"]);

        return json_encode(["hasError" => false, "data" => $posts->get()]);
    }
    public function list(){
        return view("postList" , ["posts" => Post::all()]);
    }
}
