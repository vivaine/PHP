<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lending;
use App\Models\Book;
use App\User;
use DB;
use Validator;
use Carbon\Carbon;
use Auth;

class LendingController extends Controller {

	function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{

		$lending_query = Lending::with('user');		

		if(Auth::user()->role==0) {
			$lending_query->where('user_id', Auth::user()->id);
		}

		$lendings = $lending_query->get();

		$books = Book::get();
		$selected_books = [];

		return view('lending.index', compact('lendings', 'books', 'selected_books'));
	}

	public function add()
	{

		$query = DB::table('books as b')
			->select('b.id', 'b.title', 'b.description', 'b.image')
			->leftjoin(DB::raw('(SELECT DISTINCT b2.id 
				       from books b2 
				           inner join books_lendings bl on (b2.id=bl.book_id) 
				           inner join lendings l on (bl.lending_id=l.id) 
				       where l.date_finish is null) as bld'),
			function($join)
			{
				$join->on('b.id', '=', 'bld.id');
			})
			->whereNull('bld.id')
			->groupBy('b.id', 'b.title', 'b.description', 'b.image');
		$books = $query->get();
		$users = User::get();

		return view('lending.add', compact('books', 'users'));
	}

	public function save(Request $request)
	{
		
		$books = $request->input('book');
		$user = $request->input('user');

		if ((empty($user)) || (Auth::user()->role=0)) {
			$user = Auth::user()->id;
		}

		if (!empty($books)) {

			$lending = Lending::create([
				'user_id' => $user,
				'date_start' => Carbon::now(),
				'date_end' => Carbon::now()->addDays(7)
			]);

			$lending->books()->sync($request->input('book'));
				
		}

		return redirect()->route('lending.index');
		
	}

	public function giveBack($id) 
	{
		$lending = Lending::find($id);


		if(!empty($lending)){

			$lending->update([
				'date_finish' => Carbon::now()
				]);
 	    }

		return redirect()->route('lending.index');
	}	

	public function search(Request $request) 
	{
		$name = $request->input('title');
		$search = TRUE;

		if($name){
			$author = Book::where('title', 'like', '%'.$name.'%')->get();
		}

		return view('book.index', compact('books', 'search'));

	}	
}