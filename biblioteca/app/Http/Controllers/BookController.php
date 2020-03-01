<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use DB;
use Validator;

class BookController extends Controller {

	private $path = 'images/book';

	function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$books = Book::get();
		$authors = Author::get();
		$selected_aut = [];

		return view('book.index', compact('books', 'authors', 'selected_aut'));
	}

	public function add()
	{
		$authors = Author::get();

		return view('book.add', compact('authors'));
	}

	public function save(Request $request)
	{
		$validator = Validator::make($request->all(), 
			['title' => 'required|min:5|max:255', 
			 'description' => 'required',
			]);

		if(!$validator->fails())
		{

			if (!empty($request->file('image')) && $request->file('image')->isvalid()) {
				
				$fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
				$request->file('image')->move($this->path, $fileName);
			}		
				
			$book = Book::create([
				'title' => $request->input('title'),
				'description' => $request->input('description'),
				'image' => $fileName
			]);

			$book->authors()->sync($request->input('author'));
		
		}

		return redirect()->route('book.index');

		
	}

	public function edit($id) 
	{
		$book = Book::find($id);


		if(!empty($book)){
			$authors = Author::get();
			$selected_aut = array();

			foreach ($book->authors as $author) {
				$selected_aut[] = $author->pivot->author_id;
			}

			return view('book.edit', compact('book', 'authors', 'selected_aut'));

		}

		return redirect()->route('product.index');

	}	

	public function update(Request $request, $id)
	{

		$author = $request->input('author');
		
		$book = Book::find($id);

		if(!empty($book)) {

			if(!empty($author)){
				$book->authors()->sync($author);
			}			
	
			$book->update(['title' => $request->input('title'),
				'description' => $request->input('description')]);

			return redirect()->route('book.index');

		}

	}

	public function delete($id) 
	{
		$book = Book::find($id);

		if($book) {
			$book->authors()->detach();
			$result = $book->delete();	
		}

		return redirect()->route('book.index');
	}

	public function search(Request $request) 
	{
		$name = $request->input('title');
		$selected_aut = $request->input('author');

		$query = DB::table('books')
			->select('books.id', 'books.title', 'books.description', 'books.image')
			->join('books_authors', 'books.id', '=', 'books_authors.book_id')
			->join('authors', 'books_authors.author_id', '=', 'authors.id')
			->whereNull('books.deleted_at')
			->groupBy('books.id', 'books.title', 'books.description', 'books.image');

		if(!empty($name)) {
			$query->where('books.title', 'like', '%'.$name.'%');
		}
		if (!empty($selected_aut)){
			$query->whereIn('authors.id', $selected_aut);
		}


		//dd($query->toSql());	
		$authors = Author::get();
		$books = $query->get();

		if(empty($selected_aut)){
			$selected_aut = [];
		}

		return view('book.index', compact('books', 'authors', 'selected_aut'));

	}	
}