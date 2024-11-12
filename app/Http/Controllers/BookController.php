<?php

namespace App\Http\Controllers;

use App\Http\Requests\Books\StoreRequest;
use App\Http\Requests\Books\UpdateRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
    {
        $books = Book::when($request->genre, function($query, $genere){
            return $query->where('genre', '=', $genre);
        })->when($request->title, function($query, $title){
            return $query->where('title', 'like', '%' . $title . '%');
        })->paginate(10)->withQueryString();

        return view('books.index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();

        try {
            Book::create([
                'title'                 => $request['title'],
                'author'                => $request['author'],
                'published_year'        => $request['published_year'],
                'genre'                 => $request['genre'],
            ]);

            DB::commit();

            return redirect()->route('books.index')->with('success', 'Book created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('books.index')->with('error', 'Book creation failed: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Book $book)
    {
        $validated = $request->validated();
        DB::beginTransaction();

        try {
            $book->update([
                'title'    => $request->input('title'),
                'author'   => $request->input('author'),
                'published_year'   => $request->input('published_year'),
                'genre' => $request->input('genre'),
            ]);

            DB::commit();

            return redirect()->route('books.index')->with('success', 'Book updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('books.index')->with('error', 'Book update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        DB::beginTransaction();

        try {
            $book->delete();

            DB::commit();

            return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('books.index')->with('error', 'Book deletion failed: ' . $e->getMessage());
        }
    }
}
