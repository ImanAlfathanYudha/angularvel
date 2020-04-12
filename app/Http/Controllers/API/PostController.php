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

	public function store(Request $request)
    {
        //
        try {         
			 $post = new Post([
			       'title' => $request->get('title'),
			       'body' => $request->get('body')
			  ]);
      		$post->save();
            return response()->json([
                'status' => 'success',
                'messages'  => "successfully created an post",
                'post'  => $post,
            ], 200);
        } catch (Exception $e) {
              return response()->json([
                'status' => 'error',
                'messages'  => $e,
            ], 404);
        }
    }

     public function update(Request $request, $id)
    {
        //
        $validation = Validator::make($request->all(),[ 
            'title' => 'required',
            'body' => 'required',
        ]);
        try {
        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'messages'  => $validation->errors(),
            ], 404);
        }
        else
        {
            DB::table('post')
            ->where('id', $id)
            ->update ([
                'title' => $request["title"],
                'body' => $request["body"]
            ]);
            return response()->json([
                'status' => 'success',
                'messages'  => "successfully updating post.",
            ], 200);
        }
        } catch (Exception $e) {
                  return response()->json([
                    'status' => 'error',
                    'messages'  => "failed to update post.",
                ], 404);
        }
    }

    public function getPostDetail ($id) {
    	try {
    		$post = Post::find($id);
       		 if(is_null($post)){
            return response()->json([
                'status' => 'error',
                'message'  => "Post dengan id ".$id."tidak ditemukan",
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'post'  => $post,
        ], 200);
    	}catch (Exception $e) {
    	   report($e);
           return response()->json([
                'status' => 'error',
                'message' => $e,
            ], 404);
    	}    
    }

    public function destroy($id)
    {
        try {
            //
            $post = \App\Post::find($id);
            if($post!=null) {
                $post->delete();
                return response()->json([
                    'status' => 'success',
                    'messages'  => "successfully deleting post with id.". $id,
                ], 200);
            }
        } catch (Exception $e) {
             return response()->json([
                    'status' => 'error',
                    'messages'  => "failed deleting post.",
            ], 404);
        }
    }

}