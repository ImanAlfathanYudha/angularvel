<?php

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
	 	} catch (Exception $e) {

	 	}
	 }
}