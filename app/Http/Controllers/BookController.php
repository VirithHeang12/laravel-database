<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Http\Requests\Books\StoreRequest;
use App\Http\Requests\Books\UpdateRequest;
use App\Models\Book;
use App\Imports\BooksImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;



class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $books = Book::when($request->genre, function($query, $genere){
        //     return $query->where('genre', '=', $genre);
        // })->when($request->title, function($query, $title){
        //     return $query->where('title', 'like', '%' . $title . '%');
        $books = Book::when($request->title, function ($query, $title) {
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
        // $validated = $request->validated();
        DB::beginTransaction();

        try {
            // Book::create([
            //     'title'                 => $request['title'],
            //     'author'                => $request['author'],
            //     'published_year'        => $request['published_year'],
            //     'genre'                 => $request['genre'],
            // ]);

            Book::updateOrCreate(
                [
                    'title' => $request['title']
                ],
                [
                    'author'          => $request['author']
                ],
                [
                    'published_year'          => $request['published_year']
                ],
                [
                    'genre'          => $request['genre']
                ]
            );

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
        // $validated = $request->validated();
        DB::beginTransaction();

        try {
            $book->update([
                'title'             => $request->input('title'),
                'author'            => $request->input('author'),
                'published_year'    => $request->input('published_year'),
                'genre'             => $request->input('genre'),
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

    /**
     * Display deleted Books.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function deletedBooks()
    {
        $deletedBooks = Book::onlyTrashed()->get();

        return view('books.deleted-books', [
            'books' => $deletedBooks
        ]);
    }

    // restore books after they were removed
    public function restoreBook($id)
    {
        $book = Book::withTrashed()->find($id);

        DB::beginTransaction();

        try {
            $book->restore();

            DB::commit();

            return redirect()->route('books.index')->with('success', 'Book restored successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('books.index')->with('error', 'Book restoration failed');
        }
    }


    public function restoreAllBook()
    {
        Book::withTrashed()->restore();

        return redirect()->route('books.index')->with('success', 'All books restored successfully');
    }

    /**
     * Show the form for importing books.
     *
     * @return \Illuminate\Http\Response
     */
    public function createImport()
    {
        return view('books.import');
    }

    /**
     * Import books from Excel file.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $import = new BooksImport;

        Excel::import($import, $request->file('file'));

        $successes = $import->getSuccesses();
        // $fails = $import->getFails();

        // if (count($fails) > 0) {
        //     $export = new BooksExport;
        //     $export->setFails(collect($fails));
        //     $export->setSuccessesCount(count($successes));
        //     $export->setFailsCount(count($fails));

        //     return Excel::download($export, 'results.xlsx');
        // }

        return redirect()
            ->route('books.index')
            ->with('success', 'Successfully imported ' . count($successes) . ' books');
    }

    /**
     * Export products to Excel file.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }

    /**
     * Export products using FromView.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportView(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new BooksExport, 'books.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
