<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use Validator;

class ApiController extends Controller{

	public function books(){
		$books = Book::with(['authors'])->get();
		return response()->json($books);
	}


	
}
