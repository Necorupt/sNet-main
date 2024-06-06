<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscribeController extends Controller
{
    public function getSubcribedPost(Request $request){
        
        if(!$request->has("user_id")){
            return json_encode(["hasError" => true, "error" => "requers user_id"]);
        }
        
        $input = $request->all();
        
        $subscribedOn = Friends::where([
            ["dst_id", "=", $input["user_id"]],
            ["isSubscriber" , '=' , false],
        ])->orWhere([
            ["src_id", "=", $input["user_id"]],
        ])->get();

        $subList = array();

        foreach($subscribedOn as $key => $value){
        if(!$value["isSubscriber"] && $value["dst_id"] == $input["user_id"]){
            $subList[] = $value["src_id"];
        }
        else if(!$value["isSubscriber"] && $value["src_id"] == $input["user_id"]){
            $subList[] = $value["dst_id"];
        }
        else
            $subList[] = $value["dst_id"];
        
        }

        log::debug($subList);

        $posts = Post::whereIn('user_id',$subList)->get();
        
        return json_encode(["hasError" => false, "data" => $posts]);
    }
}
