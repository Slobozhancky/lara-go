<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author\Author;
use App\Models\Author\Book;

class BooksController extends Controller
{
    public function books ()
    {
        $title = 'Books page';
        $books = Book::all();
        $authors = Author::with('books')->get();


        foreach($authors as $author){
            echo $author->name . "<br>";

            foreach($author->books as $books){ // ось тут була проблема, що я звертався не до AUTHOR, а до AUTHORS
                // тобто до всіх авторів
                echo $books->name . "<br>";
            }

            echo "<hr>";
        }

//        return view('books.index', compact('books', 'title', 'authors'));
    }
    public function author (int $id)
    {
        $title = 'Author page';
        $author = Author::query()->find($id);
        $books = Author::find($id)->books->toArray();

        dump($author->books);

        return view('books.author', compact('author', 'title', 'books'));
    }


}
