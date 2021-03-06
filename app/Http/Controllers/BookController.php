<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Book;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(){
      $books = Book::all();
      
      return $this->succesResponse($books);
    }

    public function store(Request $request){
      $rules = [
          'title' => 'required|max:255',
          'description'=> 'required|max:255',
          'price' => 'required|min:1',
          'author_id' => 'required|min:1',
      ];

      $this->validate($request, $rules);

      $book = Book::create($request->all());

      return $this->succesResponse($book, Response::HTTP_CREATED);
    }

    public function show($book){
        $book = Book::findOrFail($book);

        return $this->succesResponse($book);
       
    }

    public function update(Request $request, $book){
      $rules = [
          'title' => 'required|max:255',
          'description'=> 'required|max:255',
          'price' => 'required|min:1',
          'author_id' => 'required|min:1',
      ];
      $this->validate($request, $rules);
      $book = Book::findOrFail($book);
      $book->fill($request->all());

      if($book->isClean()){
          return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
      }
      $book->save();

      return $this->succesResponse($book);
    }

    public function destroy($book){
      $book = Book::findOrFail($book);

      $book->delete();

      return $this->succesResponse($book);
    }

}
