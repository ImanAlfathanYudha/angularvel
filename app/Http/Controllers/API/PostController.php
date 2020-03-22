<?php

namespace App\Http\Controllers\API;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
	public function getAllPost() {
	 	try {
	 		$listPost = DB::table('post')->get();
	 		// print('tes $listPost '.$listPost);
	 		 return response()->json([
                'message' => 'success',
                'posts'  => $listPost,
            ], 200);
	 	} catch (Exception $e) {
            report($e);
           return response()->json([
                'status' => 'error',
                'message' => $e,
            ], 404);
        }
	}
}