<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {

    }
    public function edit()
    {

    }

    public function addFriend(Request $request)
    {
        log::debug($request);
        if (!$request->has("target_id")) {
            return json_encode(["hasError" => true, "error" => "requered target_id"]);
        }

        $input = $request->all();

        if(Auth::user()->id == $input["target_id"]) {
            return json_encode(["hasError" => true, "error" => "invalid target_id"]);
        }


        if (
            Friends::where([
                ['src_id', '=', Auth::user()['id']],
                ['dst_id', '=', $input['target_id']]
            ])->count() != 0
        ) {
            return json_encode(["hasError" => true, "error" => "is already subscriber"]);
        }

        $isFriend = false;

        if (
            Friends::where([
                ['dst_id', '=', Auth::user()['id']],
                ['src_id', '=', $input['target_id']]
            ])->count() != 0
        ) {
            $isFriend = true;
        }

        if (!$isFriend)
            $friends = Friends::create([
                "src_id" => Auth::user()["id"],
                "dst_id" => $input["target_id"],
                "isSubscriber" => true,
            ]);
        else {
            $friend = Friends::where([
                ['dst_id', '=', Auth::user()['id']],
                ['src_id', '=', $input['target_id']]
            ])->first();
            $friend->isSubscriber = false;
            $friend->save();
        }
        return json_encode([
            "hasError" => false,
            "data" => [
                "isFriend" => $isFriend
            ]
        ]);
    }
    public function getUserInfoById(Request $request)
    {

        if (!$request->has("id")) {
            return json_encode(["hasError" => true, "error" => "requers id"]);
        }

        $input = $request->all();
        $user = User::find($input["id"]);
        if ($user) {
            return json_encode(["hasError" => false, "data" => $user]);
        }
        return json_encode(["hasError" => true, "error" => "user not exist"]);
    }

    public function getSelfInfo()
    {
        $user = Auth::user();
        if ($user) {
            return json_encode(["hasError" => false, "data" => $user]);
        }
        return json_encode(["hasError" => true, "error" => "not logined"]);
    }

    public function getSelfSubscribers()
    {
        $subscribers = Friends::where([
            ["dst_id", "=", Auth::user()["id"]],
            ["isSubscriber" , '=' , true],
        ])->get();

        return json_encode(["hasError" => false, "data" => $subscribers]);
    }

    public function getFriends(Request $request){
        if (!$request->has("id")) {
            return json_encode(["hasError" => true, "error" => "requers id"]);
        }

        $input = $request->all();
        $friends = Friends::where([
            ["dst_id", "=", $input["id"]],
            ["isSubscriber" , '=' , false],
        ])->orWhere([
            ["src_id", "=", $input["id"]],
            ["isSubscriber" , '=' , false],
        ])->get();

        return $friends;
    }

    public function update(Request $request)
    {
        $avatar_url = '';
        $user = Auth::user();
        log::debug($request);
        if ($request->has("avatar_image"))
            $avatar_url = $request->file("avatar_image")->store("images");
        else {
            log::debug("doesn't have avatar image");
            $avatar_url = $user["avatar_url"];
        }
        $input = $request->all();

        User::where("id", Auth::user()->id)->update([
            "name" => $input["name"],
            "lastname" => $input["lastname"],
            "avatar_url" => $avatar_url
        ]);

        return redirect("/");
    }
    public function settings()
    {
        return view("userSettings", ["user" => User::where("id", Auth::user()->id)->first()]);
    }

    public function list(string $id)
    {
        return view("userList",["users" => User::all()]);
    }
}
