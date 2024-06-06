<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ActionType;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    public function likePost(Request $request) : JsonResponse{
        
        $input = $request->all();
       
        DB::beginTransaction();

        $likeAction = ActionType::where('name' , 'LikePost')->first();


        /*if(Action::where([
            ['action_type','=', $likeAction['value']],
            ['dst_id', '=',$input['dst_id']],
            ['src_id','=',auth()->id()]
        ])->get() != NULL){
            return response()->json(["error"=>"alreadyMakeLike"]);
        };*/

        $action = Action::create(['action_type' => $likeAction['value'],
                                  'dst_id'=>$input['dst_id'],
                                  'src_id' => auth()->id()]
    );
        DB::commit();

        return response()->json("");
    }
}
