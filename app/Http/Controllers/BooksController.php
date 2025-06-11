<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    // View a single book by ID
    public function show($id)
    {
        $book = Books::findOrFail($id);
        return view('book.view_book', compact('book'));
    }
    public function library(Request $request)
    {
        $search = $request->get('search');
        $query = Books::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('genre', 'like', "%{$search}%");
            });
        }
        $library = $query->get();
        return view('welcome', compact('library'));
    }
    public function newBook()
    {

        return view('book.new_Book');
    }
    public function saveBook(Request $request)
    {
        //  dd($request);

        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'ISBN' => 'required|numeric',
            'edition' => 'required|string',
            'genre' => 'required|string',
            'cost' => 'required|string',
            'price' => 'required|string',
            'quantity' => 'required|numeric',
            'coverImage' => 'nullable|mimes:jpg,jpeg,png,gif|max:10000'
        ]);

        $imageName = time() . "." . $request->coverImage->extension();
        $request->coverImage->move(public_path('Cover_images'), $imageName);



        $library_table = new Books();

        $library_table->title = $request->title;
        $library_table->author = $request->author;
        $library_table->publisher = $request->publisher;
        $library_table->ISBN = $request->ISBN;
        $library_table->edition = $request->edition;
        $library_table->genre = $request->genre;
        $library_table->cost = number_format($request->cost,2);
        $library_table->price = number_format($request->price,2);
        $library_table->quantity = number_format($request->quantity,2) ;
        $library_table->cover_photo = $imageName;   
        if ($library_table->save()) {
            return redirect(route('inventory'));
        }
    }


    public function editbook($id)
    {

        $books = Books::where('id', $id)->first();
        return view('book.update_book', compact('books'));
    }


    public function updateBook(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'ISBN' => 'required|numeric',
            'edition' => 'required|string',
            'genre' => 'required|string',
            'cost' => 'required|string',
            'price' => 'required|string',
            'quantity' => 'required|numeric',
        ]);


        $book = Books::findOrFail($id);
        $book->update($request->all());

        return redirect()->route('library');
    }
}
